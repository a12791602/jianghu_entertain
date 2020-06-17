<?php

namespace App\Http\Resources\Frontend\Common\TopUp;

use App\Http\Resources\BaseResource;
use App\Models\Finance\SystemFinanceType;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Collection;

/**
 * Class OfflineInfoResource
 * @package App\Http\Resources\Frontend\Common\TopUp
 */
class OfflineInfoResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request $request Request.
     * @return mixed[]
     */
    public function toArray($request): array
    {
        unset($request);
        $financeType = $this->resource;
        if (!$financeType instanceof SystemFinanceType) {
            return [];
        }
        $offlineInfo = null;
        $bank        = null;
        if ($financeType->offlineInfos()->exists()) {
            $offlineInfo              = $financeType->offlineInfos()->get(
                [
                 'id',
                 'account',
                 'branch',
                 'username',
                 'type_id',
                 'min_amount',
                 'max_amount',
                 'service_fee',
                 'bank_id',
                ],
                )->random();
            $offlineInfo->min_amount  = floatDC($offlineInfo->min_amount);
            $offlineInfo->max_amount  = floatDC($offlineInfo->max_amount);
            $offlineInfo->service_fee = floatDC($offlineInfo->service_fee);
            $bank                     = $offlineInfo->bank()->select('id', 'name', 'code')->first();
        }
        $data                             = [
                                             'id'               => $financeType->id,
                                             'name'             => $financeType->name,
                                             'sign'             => $financeType->sign,
                                             'transfer_account' => $offlineInfo,
                                            ];
        $data['transfer_account']['bank'] = $bank;
        return $data;
    }
}
