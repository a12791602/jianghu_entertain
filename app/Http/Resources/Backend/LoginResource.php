<?php

namespace App\Http\Resources\Backend;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class LoginResource
 * @package App\Http\Resources\Backend\Headquarters
 */
class LoginResource extends JsonResource
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
                   'id'             => $this->id,
                   'name'           => $this->name,
                   'email'          => $this->email,
                   'remember_token' => $this->remember_token,
                   'group_id'       => $this->group_id,
                   'status'         => $this->status,
                   'created_at'     => $this->created_at,
                   'token_type'     => 'Bearer',
                  ];
        return $result;
    }
}
