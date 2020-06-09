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
                'account'     => $this->resource->account,
                'branch'      => $this->resource->branch,
                'username'    => $this->resource->username,
                'type_id'     => $this->resource->type_id,
                'min_amount'  => (float) sprintf('%.2f', $this->resource->min_amount),
                'max_amount'  => (float) sprintf('%.2f', $this->resource->max_amount),
                'service_fee' => (float) sprintf('%.2f', $this->resource->service_fee),
                'bank'        => $this->resource->bank,
               ];
    }
}
