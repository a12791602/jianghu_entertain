<?php

namespace App\Http\Resources\Backend\Headquarters\Setting\SmsConfig;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class IndexResource
 * @package App\Http\Resources\Backend\Headquarters\Setting\SmsConfig
 */
class IndexResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request Request.
     * @return mixed[]
     */
    public function toArray($request): array
    {
        $result = [
            'id'                 => $this->id,
            'name'               => $this->name,
            'sign'               => $this->sign,
            'merchant_code'      => $this->merchant_code,
            'merchant_secret'    => $this->merchant_secret,
            'public_key'         => $this->public_key,
            'authorization_code' => $this->authorization_code,
            'sms_num'            => $this->sms_num,
            'url'                => $this->url,
            'status'             => $this->status,
            'last_editor_name'   => $this->admin->name,
            'updated_at'         => $this->updated_at,
            'created_at'         => $this->created_at,
        ];
        return $result;
    }
}
