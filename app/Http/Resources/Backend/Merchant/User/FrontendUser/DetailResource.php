<?php

namespace App\Http\Resources\Backend\Merchant\User\FrontendUser;

use App\Http\Resources\BaseResource;
use App\Models\User\FrontendUsersAccount;
use App\Models\User\FrontendUsersSpecificInfo;
use App\Models\User\UsersTag;
use Carbon\Carbon;

/**
 * Class DetailResource
 * @package App\Http\Resources\Backend\Merchant\User\FrontendUser
 */
class DetailResource extends BaseResource
{

    /**
     * @var string $guid Guid.
     */
    private $guid;

    /**
     * @var string $last_login_time 最后登录ip.
     */
    private $last_login_time;

    /**
     * @var FrontendUsersSpecificInfo $specificInfo 用户扩展信息.
     */
    private $specificInfo;

    /**
     * @var FrontendUsersAccount $account 用户账户.
     */
    private $account;

    /**
     * @var string $type 用户类型.
     */
    private $type;

    /**
     * @var string $status 用户状态.
     */
    private $status;

    /**
     * @var UsersTag $userTag 用户标签.
     */
    private $userTag;

    /**
     * @var string $device_code 设备code.
     */
    private $device_code;

    /**
     * @var string $last_login_ip 最后登录IP.
     */
    private $last_login_ip;

    /**
     * @var string $created_at 创建时间.
     */
    private $created_at;

    /**
     * @var string $register_ip 注册ip
     */
    private $register_ip;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request Request.
     * @return mixed[]
     */
    public function toArray($request): array
    {
        // TODO 财务信息和推广信息 待处理
        $last_seen_time = Carbon::parse($this->last_login_time)->diffForHumans();

        $result = [
                   'guid'              => $this->guid,
                   'name'              => $this->specificInfo->nickname,
                   'level'             => $this->specificInfo->level,
                   'balance'           => $this->account->balance,
                   'type'              => $this->type,
                   'status'            => $this->status,
                   'title'             => $this->userTag->title,
                   'promotion_details' => [
                                           'total_members'      => $this->specificInfo->total_members,
                                           'promotion_level'    => null,
                                           'commission_balance' => null,
                                          ],
                   'finance_info'      => [],
                   'other_info'        => [
                                           'device'             => $this->device_code,
                                           'last_login_ip'      => $this->last_login_ip,
                                           'last_login_address' => null,
                                           'last_login_time'    => $this->last_login_time,
                                           'last_seen_time'     => $last_seen_time,
                                           'register_type'      => $this->specificInfo->register_type,
                                           'register_ip'        => $this->register_ip,
                                           'number_of_logins'   => null,
                                           'created_at'         => $this->created_at,
                                          ],
                  ];
        return $result;
    }
}
