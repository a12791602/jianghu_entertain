<?php

namespace App\Http\Resources\Frontend\AccountManagement;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class SystemSlidesResource
 * @package App\Http\Resources\GamesLobby
 */
class AccountListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request $request Request.
     * @return mixed[]
     */
    public function toArray($request): array
    {
        $result = [
                   'id'                 => $this->id,
                   'code'               => $this->code,         // 银行编码
                   'owner_name'         => $this->owner_name,   // 名称
                   'card_number_hidden' => $this->card_number_hidden, // 卡号
                  ];
        return $result;
    }
}
