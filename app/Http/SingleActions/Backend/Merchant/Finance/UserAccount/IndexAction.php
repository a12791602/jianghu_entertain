<?php

namespace App\Http\SingleActions\Backend\Merchant\Finance\UserAccount;

use App\Http\SingleActions\MainAction;
use App\Models\User\FrontendUsersAccountsReport;
use Illuminate\Http\JsonResponse;

/**
 * Class IndexAction
 * @package App\Http\SingleActions\Backend\Merchant\Finance\UserAccount
 */
class IndexAction extends MainAction
{
    /**
     * @param array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $userAccountReport = new FrontendUsersAccountsReport();
        if (isset($inputDatas['pageSize'])) {
            $userAccountReport->setPerPage($inputDatas['pageSize']);
        }
        $inputDatas['platform_sign'] = $this->currentPlatformEloq->sign;
        $result                      = $userAccountReport->filter($inputDatas)
            ->select(
                [
                 'serial_number',
                 'type_name',
                 'user_id',
                 'in_out',
                 'type_sign',
                 'before_balance',
                 'amount',
                 'balance',
                 'frozen_balance',
                 'created_at',
                 'params->game_vendor_name as game_vendor_name',
                ],
            )->with('user:id,mobile,guid')
            ->orderBy('created_at', 'desc')
            ->paginate()
            ->toArray();
        $data                        = $result['data'];
        $result['data']              = [];
        foreach ($data as $report) {
            $result['data'][] = [
                                 'serial_number'    => $report['serial_number'],
                                 'type_name'        => $report['type_name'],
                                 'game_vendor_name' => $report['game_vendor_name'] ?? '--',
                                 'mobile'           => $report['user']['mobile'] ?? '',
                                 'guid'             => $report['user']['guid'] ?? '',
                                 'in_out'           => $report['in_out'],
                                 'type_sign'        => $report['type_sign'],
                                 'before_balance'   => $report['before_balance'],
                                 'amount'           => $report['amount'],
                                 'balance'          => $report['balance'],
                                 'frozen_balance'   => $report['frozen_balance'],
                                 'created_at'       => $report['created_at'],
                                ];
        }
        return msgOut($result);
    }
}
