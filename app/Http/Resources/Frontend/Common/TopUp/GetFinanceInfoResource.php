<?php

namespace App\Http\Resources\Frontend\Common\TopUp;

use App\Http\Resources\BaseResource;
use Illuminate\Http\Request;

/**
 * Class GetFinanceInfoResource
 * @package App\Http\Resources\Frontend\Common\TopUp
 */
class GetFinanceInfoResource extends BaseResource
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
        $offlineInfos = $this->resource->offlineInfos->filter();
        $offline_item = null;
        if ($offlineInfos->isNotEmpty()) {
            $offline_info = $offlineInfos->random();
            $offline_item = OfflineInfoResource::make($offline_info);
        }
        return [
                'id'            => $this->resource->id,
                'name'          => $this->resource->name,
                'sign'          => $this->resource->sign,
                'is_online'     => $this->resource->is_online,
                'offline_infos' => $offline_item,
               ];
    }
}
