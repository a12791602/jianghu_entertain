<?php

namespace App\Http\SingleActions\Backend\Merchant\User\Commission;

use App\Http\SingleActions\MainAction;
use App\ModelFilters\User\UsersCommissionConfigFilter;
use App\Models\User\FrontendUserLevel;
use App\Models\User\UsersCommissionConfig;
use App\Models\User\UsersCommissionConfigDetail;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * 洗码设置-添加
 */
class DoAddAction extends MainAction
{

    /**
     * @var object
     */
    protected $model;

    /**
     * @var array
     */
    protected $inputDatas;

    /**
     * @param UsersCommissionConfig $usersCommissionConfig 洗码Model.
     * @param Request               $request               Request.
     * @throws \Exception Exception.
     */
    public function __construct(UsersCommissionConfig $usersCommissionConfig, Request $request)
    {
        parent::__construct($request);
        $this->model = $usersCommissionConfig;
    }

    /**
     * @param array $inputDatas 接收的参数.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $this->inputDatas = $inputDatas;
        $sign             = $this->currentPlatformEloq->sign;
        $userGrade        = FrontendUserLevel::where('platform_sign', $sign)->get();

        //获取当前游戏平台的洗码设置
        $filterArr        = [
                             'platformSign' => $sign,
                             'gameTypeId'   => $this->inputDatas['game_type_id'],
                             'gameVendorId' => $this->inputDatas['game_vendor_id'],
                            ];
        $commissionConfig = $this->model->filter($filterArr, UsersCommissionConfigFilter::class)->get();

        //验证数据是否合法
        $percentArr = $this->_dataValidation($commissionConfig, $userGrade);

        //验证通过 开始插入数据
        DB::beginTransaction();
        $this->_insertConfig($sign);
        $this->_insertConfigDetail($userGrade, $percentArr);
        DB::commit();
        //插入数据成功

        $msgOut = msgOut();
        return $msgOut;
    }

    /**
     * @param  Collection $commissionConfig 平台标识.
     * @param  Collection $userGrade        用户等级Eloq.
     * @throws \Exception Exception.
     * @return mixed[]
     */
    private function _dataValidation(Collection $commissionConfig, Collection $userGrade): array
    {
        //检查洗码设置的数据是否完整
        $percentArr = json_decode($this->inputDatas['percent'], true);
        if (!is_array($percentArr)) {
            throw new \Exception('200802');
        }
        if (count($percentArr) !== $userGrade->count()) {
            throw new \Exception('200802');
        }

        $currentPercent = 0;
        foreach ($percentArr as $percent) {
            if ($percent < $currentPercent) {
                throw new \Exception('200817');
            }
            $currentPercent = $percent;
        }
        //存在洗码设置时才需要去验证数据是否合法
        if ($commissionConfig->isNotEmpty()) {
            //检查该打码量的洗码设置是否重复
            if ($commissionConfig->contains('bet', $this->inputDatas['bet'])) {
                throw new \Exception('200801');
            }
            //洗码比例不能低于上一级
            $beforeConfig = $commissionConfig->where('bet', '<', $this->inputDatas['bet'])->sortByDesc('bet')->first();
            if ($beforeConfig) {
                $this->_checkBeforePercent($beforeConfig, $percentArr);
            }
            //洗码比例不能高于下一级
            $afterConfig = $commissionConfig->where('bet', '>', $this->inputDatas['bet'])->sortBy('bet')->first();
            if ($afterConfig) {
                $this->_checkAfterPercent($afterConfig, $percentArr);
            }
        }
        return $percentArr;
    }

    /**
     * @param string $sign 平台标识.
     * @throws \Exception Exception.
     * @return void
     */
    private function _insertConfig(string $sign): void
    {
        $insertData = [
                       'platform_sign'  => $sign,
                       'game_type_id'   => $this->inputDatas['game_type_id'],
                       'game_vendor_id' => $this->inputDatas['game_vendor_id'],
                       'bet'            => $this->inputDatas['bet'],
                      ];
        $this->model->fill($insertData);
        if (!$this->model->save()) {
            DB::rollback();
            throw new \Exception('200807');
        }
    }

    /**
     * @param Collection $userGrade  当前平台所有的用户等级Eloq.
     * @param array      $percentArr 各个等级的洗码比例.
     * @throws \Exception Exception.
     * @return void
     */
    private function _insertConfigDetail(Collection $userGrade, array $percentArr): void
    {
        foreach ($percentArr as $gradeExp => $percent) {
            $grade = $userGrade->where('experience_max', $gradeExp)->first();
            if (!$grade) {
                throw new \Exception('200809');
            }
            $insertData       = [
                                 'config_id'     => $this->model->id,
                                 'grade_id'      => $grade->id,
                                 'percent'       => $percent,
                                 'grade_exp_max' => $gradeExp,
                                ];
            $commissionDetail = new UsersCommissionConfigDetail();
            $commissionDetail->fill($insertData);
            if (!$commissionDetail->save()) {
                DB::rollback();
                throw new \Exception('200810');
            }
        }
    }

    /**
     * @param  UsersCommissionConfig $beforeConfig 上一列数据Eloq.
     * @param  array                 $percentArr   当前数据的洗码比例数组.
     * @throws \Exception Exception.
     * @return void
     */
    private function _checkBeforePercent(
        UsersCommissionConfig $beforeConfig,
        array $percentArr
    ): void {
        $beforeDetail = $beforeConfig->configDetail;
        foreach ($percentArr as $gradeExp => $percent) {
            $beforeData = $beforeDetail->where('grade_exp_max', $gradeExp)->first();
            if (!$beforeData) {
                throw new \Exception('200803');
            }
            if ($percent < $beforeData->percent) {
                throw new \Exception('200804');
            }
        }
    }

    /**
     * @param  UsersCommissionConfig $afterConfig 下一列数据Eloq.
     * @param  array                 $percentArr  当前数据的洗码比例数组.
     * @throws \Exception Exception.
     * @return void
     */
    private function _checkAfterPercent(
        UsersCommissionConfig $afterConfig,
        array $percentArr
    ): void {
        $afterDetail = $afterConfig->configDetail;
        foreach ($percentArr as $gradeExp => $percent) {
            $afterData = $afterDetail->where('grade_exp_max', $gradeExp)->first();
            if (!$afterData) {
                throw new \Exception('200805');
            }
            if ($percent > $afterData->percent) {
                throw new \Exception('200806');
            }
        }
    }
}
