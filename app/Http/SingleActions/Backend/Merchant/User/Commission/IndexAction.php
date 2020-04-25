<?php

namespace App\Http\SingleActions\Backend\Merchant\User\Commission;

use App\Http\SingleActions\MainAction;
use App\Models\User\UsersCommissionConfig;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * 洗码设置列表
 */
class IndexAction extends MainAction
{

    /**
     * @var object
     */
    protected $model;

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
        $inputDatas['platformSign'] = $this->currentPlatformEloq->sign;
        $datas                      = $this->model
            ->filter($inputDatas)
            ->with('configDetail.userGrade')
            ->get(['id', 'game_type_id', 'game_vendor_id', 'bet']);

        $returnData = [];
        foreach ($datas as $dataKey => $item) {
            $returnData[$dataKey] = [
                                     'id'             => $item->id,
                                     'game_type_id'   => $item->game_type_id,
                                     'game_vendor_id' => $item->game_vendor_id,
                                     'bet'            => $item->bet,
                                    ];
            $percentData          = [];
            foreach ($item->configDetail as $config) {
                $percentData[] = [
                                  'grade_name' => $config->userGrade->name,
                                  'percent'    => $config->percent,
                                 ];
            }
            $returnData[$dataKey]['percent_data'] = $percentData;
        }
        return msgOut($returnData);
    }
}
