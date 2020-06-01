<?php

namespace App\Http\Resources\Frontend\Common\TopUp;

use App\Http\Resources\BaseResource;
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
        return [
                'id'          => $this->resource->id,
                'type_id'     => $this->resource->type_id,
                'name'        => $this->resource->name,
                'remark'      => $this->resource->remark,
                'min_amount'  => $this->resource->min_amount,
                'max_amount'  => $this->resource->max_amount,
                'service_fee' => $this->resource->service_fee,
                'bank'        => $this->resource->bank,
               ];
    }
}
