<?php

namespace App\Http\Resources\Frontend\Common\TopUp;

use App\Http\Resources\BaseResource;
use Illuminate\Http\Request;

/**
 * Class FinanceTypeResource
 * @package App\Http\Resources\Frontend\Common\TopUp
 */
class FinanceTypeResource extends BaseResource
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
        return [
                'online_infos'  => [],
                'offline_infos' => FinanceInfoResource::collection($this->resource),
               ];
    }
}
