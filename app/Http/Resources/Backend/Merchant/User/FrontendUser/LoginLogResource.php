<?php

namespace App\Http\Resources\Backend\Merchant\User\FrontendUser;

use App\Http\Resources\BaseResource;
use App\Models\User\FrontendUsersAccount;
use App\Models\User\FrontendUsersSpecificInfo;
use App\Models\User\UsersTag;
use Carbon\Carbon;

/**
 * Class LoginLogResource
 * @package App\Http\Resources\Backend\Merchant\User\FrontendUser
 */
class LoginLogResource extends BaseResource
{

    /**
     * @var string $mobile 手机号码.
     */
    private $mobile;

    /**
     * @var \App\Models\User\FrontendUser $user 用户.
     */
    private $user;

    /**
     * @var string $ip Ip.
     */
    private $ip;

    /**
     * @var string $device 设备.
     */
    private $device;

    /**
     * @var integer $web_type 站点类型.
     */
    private $web_type;

    /**
     * @var \Carbon\Carbon $created_at 登录时间.
     */
    private $created_at;

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
                'mobile'     => $this->mobile,
                'guid'       => $this->user->guid ?? '',
                'ip'         => $this->ip,
                'device'     => $this->device,
                'web_type'   => $this->web_type,
                'created_at' => $this->created_at->toDateTimeString(),
               ];
    }
}
