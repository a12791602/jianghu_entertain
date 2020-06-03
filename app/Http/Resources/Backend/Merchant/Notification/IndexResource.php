<?php

namespace App\Http\Resources\Backend\Merchant\Notification;

use App;
use App\Http\Resources\BaseResource;
use App\Models\Game\Game;

/**
 * Class IndexResource
 * @package App\Http\Resources\Backend\Merchant\Notification
 */
class IndexResource extends BaseResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request Request.
     * @return mixed[]
     */
    public function toArray($request): array
    {
        unset($request);
        return [
                'email'             => $this->resource['email'],
                'online_top_up'     => $this->resource['online_top_up'],
                'offline_top_up'    => $this->resource['offline_top_up'],
                'withdrawal_order'  => $this->resource['withdrawal_order'],
                'withdrawal_review' => $this->resource['withdrawal_review'],
               ];
    }
}
