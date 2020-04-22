<?php

namespace App\Http\Resources\Backend\Merchant\Auth;

use App\Http\Resources\BaseResource;

/**
 * Class LoginResource
 * @package App\Http\Resources\Backend\Merchant\Auth
 */
class LoginResource extends BaseResource
{

    /**
     * @var integer $id 管理员Id.
     */
    private $id;

    /**
     * @var string $name 管理员名称.
     */
    private $name;

    /**
     * @var string $email 管理员邮箱.
     */
    private $email;

    /**
     * @var string $remember_token 管理员token.
     */
    private $remember_token;

    /**
     * @var string $remember_token 管理员组id.
     */
    private $group_id;

    /**
     * @var string $status 管理员状态.
     */
    private $status;

    /**
     * @var string $created_at 管理员创建时间.
     */
    private $created_at;

    /**
     * @var object $platform 管理员所属平台Eloq.
     */
    private $platform;

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
                'id'             => $this->id,
                'name'           => $this->name,
                'email'          => $this->email,
                'remember_token' => $this->remember_token,
                'group_id'       => $this->group_id,
                'status'         => $this->status,
                'created_at'     => $this->created_at,
                'token_type'     => 'Bearer',
                'platform_sign'  => $this->platform->sign ?? 'JHHY',
               ];
    }
}
