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
class OnlineInfoResource extends BaseResource
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
        if ($financeType->onlineInfos()->exists()) {
            $offlineInfo = $financeType->onlineInfos()->get(
                [
                 'system_finance_online_infos.id as id',
                 'system_finance_online_infos.frontend_name as frontend_name',
                 'system_finance_online_infos.min_amount as min_amount',
                 'system_finance_online_infos.max_amount as max_amount',
                 'system_finance_online_infos.handle_fee as service_fee',
                ],
                );
            $offlineInfo->each(
                static function ($item): void {
                    $item->makeHidden('laravel_through_key');
                },
            );
        }
        return [
                'id'      => $financeType->id,
                'name'    => $financeType->name,
                'sign'    => $financeType->sign,
                'gateway' => $offlineInfo,
               ];
    }
}
