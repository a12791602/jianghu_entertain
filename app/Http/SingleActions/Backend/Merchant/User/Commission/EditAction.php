<?php

namespace App\Http\SingleActions\Backend\Merchant\User\Commission;

use App\Http\Controllers\BackendApi\BackEndApiMainController;
use App\ModelFilters\User\UsersCommissionConfigFilter;
use App\Models\User\UsersCommissionConfig;
use App\Models\User\UsersGrade;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

/**
 * 洗码设置-编辑
 */
class EditAction
{

    /**
     * @var object
     */
    protected $model;

    /**
     * @var mixed
     */
    protected $userGrade;

    /**
     * @var array
     */
    protected $inputDatas = [];

    /**
     * @var UsersCommissionConfig.
     */
    protected $commissionConfig;

    /**
     * @param UsersCommissionConfig $usersCommissionConfig 洗码Model.
     */
    public function __construct(UsersCommissionConfig $usersCommissionConfig)
    {
        $this->model = $usersCommissionConfig;
    }

    /**
     * @param BackEndApiMainController $contll     Controller.
     * @param array                    $inputDatas 接收的参数.
     * @throws \Exception Exception.
     * @return JsonResponse
     */
    public function execute(BackEndApiMainController $contll, array $inputDatas): JsonResponse
    {
        $this->inputDatas       = $inputDatas;
        $this->commissionConfig = $this->model->find($this->inputDatas['id']);
        if (!$this->commissionConfig) {
            throw new \Exception('200811');
        }
        $platformSign    = $contll->currentPlatformEloq->sign;
        $this->userGrade = UsersGrade::where('platform_sign', $platformSign)->get();
        //验证数据是否合法
        $percentArr = $this->_dataValidation($platformSign);
        //开始修改数据
        DB::beginTransaction();
        $this->_editConfig();
        $this->_editDetail($percentArr);
        DB::commit();
        //数据修改完成
        $msgOut = msgOut(true);
        return $msgOut;
    }

    /**
     * @param  string $platformSign 平台标识.
     * @throws \Exception Exception.
     * @return mixed[]
     */
    private function _dataValidation(string $platformSign): array
    {
        //检查洗码设置的数据是否完整
        $percentArr = json_decode($this->inputDatas['percent'], true);
        if (!is_array($percentArr)) {
            throw new \Exception('200802');
        }
        if (count($percentArr) !== $this->userGrade->count()) {
            throw new \Exception('200802');
        }
        $filterArr             = [
                                  'notInId'      => $this->commissionConfig->id,
                                  'platformSign' => $platformSign,
                                  'gameTypeId'   => $this->commissionConfig->game_type_id,
                                  'gameVendorId' => $this->commissionConfig->game_vendor_id,
                                 ];
        $otherCommissionConfig = $this->model
                                      ->filter($filterArr, UsersCommissionConfigFilter::class)
                                      ->get();
        //存在其他的洗码设置时才需要去验证数据是否合法
        if ($otherCommissionConfig) {
            //检查该打码量的洗码设置是否重复
            if ($otherCommissionConfig->contains('bet', $this->inputDatas['bet'])) {
                throw new \Exception('200801');
            }

            //洗码比例不能低于上一级
            $beforeConfig = $otherCommissionConfig->where('bet', '<', $this->inputDatas['bet'])
                ->sortByDesc('bet')
                ->first();
            if ($beforeConfig) {
                $this->_checkBeforePercent($beforeConfig, $percentArr);
            }
            //洗码比例不能高于下一级
            $afterConfig = $otherCommissionConfig->where('bet', '>', $this->inputDatas['bet'])
                ->sortBy('bet')
                ->first();
            if ($afterConfig) {
                $this->_checkAfterPercent($afterConfig, $percentArr);
            }
        }
        return $percentArr;
    }

    /**
     * @throws \Exception Exception.
     * @return void
     */
    private function _editConfig(): void
    {
        $this->commissionConfig->bet = $this->inputDatas['bet'];
        if (!$this->commissionConfig->save()) {
            throw new \Exception('200812');
        }
    }

    /**
     * @param array $percentArr 洗码百分比数据.
     * @throws \Exception Exception.
     * @return void
     */
    private function _editDetail(array $percentArr): void
    {
        $commissionConfigDetail = $this->commissionConfig->configDetail;
        foreach ($percentArr as $gradeExp => $percent) {
            $editData      = ['percent' => $percent];
            $currentDetail = $commissionConfigDetail->where('grade_exp_max', $gradeExp)->first();
            if (!$currentDetail) {
                throw new \Exception('200813');
            }
            $currentDetail->fill($editData);
            if (!$currentDetail->save()) {
                DB::rollback();
                throw new \Exception('200814');
            }
        }
    }

    /**
     * @param  UsersCommissionConfig $beforeConfig 上一列数据Eloq.
     * @param  array                 $percentArr   当前数据的洗码比例数组.
     * @throws \Exception Exception.
     * @return void
     */
    private function _checkBeforePercent(UsersCommissionConfig $beforeConfig, array $percentArr): void
    {
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
    private function _checkAfterPercent(UsersCommissionConfig $afterConfig, array $percentArr): void
    {
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
