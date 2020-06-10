<?php

namespace App\Http\Resources\Backend\Merchant\Finance\Online;

use App\Http\Resources\BaseResource;
use App\Models\Admin\MerchantAdminUser;
use App\Models\Finance\SystemFinanceChannel;
use App\Models\Finance\SystemFinanceType;
use App\Models\Finance\SystemFinanceUserTag;
use App\Models\User\UsersTag;
use Carbon\Carbon;

/**
 * Class IndexResource
 * @package App\Http\Resources\Backend\Merchant\User\FrontendUser
 */
class IndexResource extends BaseResource
{

    /**
     * @var integer $id Id.
     */
    private $id;

    /**
     * @var string $platform_sign 平台sign.
     */
    private $platform_sign;

    /**
     * @var string $frontend_name 前台名称.
     */
    private $frontend_name;

    /**
     * @var string $frontend_remark 前台备注.
     */
    private $frontend_remark;

    /**
     * @var string $backend_name 后台名称.
     */
    private $backend_name;

    /**
     * @var string $backend_remark 后台备注.
     */
    private $backend_remark;

    /**
     * @var float $min_amount 最低入款.
     */
    private $min_amount;

    /**
     * @var float $max_amount 最高入款.
     */
    private $max_amount;

    /**
     * @var MerchantAdminUser $author 创建人.
     */
    private $author;

    /**
     * @var MerchantAdminUser $lastEditor 最近一次编辑人.
     */
    private $lastEditor;

    /**
     * @var Carbon $updated_at Updated_at.
     */
    private $updated_at;

    /**
     * @var Carbon $created_at Created_at.
     */
    private $created_at;

    /**
     * @var SystemFinanceChannel $channel SystemFinanceChannel.
     */
    private $channel;

    /**
     * @var SystemFinanceUserTag $tags 会员标签.
     */
    private $tags;

    /**
     * @var string $handle_fee 入款手续费.
     */
    private $handle_fee;

    /**
     * @var string $rebate_fee 返点.
     */
    private $rebate_fee;

    /**
     * @var string $request_url 请求地址.
     */
    private $request_url;

    /**
     * @var string $back_url 返回地址.
     */
    private $back_url;

    /**
     * @var string $merchant_code 商户号.
     */
    private $merchant_code;

    /**
     * @var string $merchant_secret 商户密钥.
     */
    private $merchant_secret;

    /**
     * @var string $public_key 第三方公钥.
     */
    private $public_key;

    /**
     * @var string $private_key 第三方私钥.
     */
    private $private_key;

    /**
     * @var string $app_id 终端号.
     */
    private $app_id;

    /**
     * @var string $vendor_url 第三方域名.
     */
    private $vendor_url;

    /**
     * @var string $level_ids 可见的用户层级.
     */
    private $level_ids;

    /**
     * @var integer $sort 排序.
     */
    private $sort;

    /**
     * @var integer $status 状态.
     */
    private $status;

    /**
     * @var integer $auto_audit 是否自动审核 1 是 0 否.
     */
    private $auto_audit;

    /**
     * @var string $merchant_no 商户编号.
     */
    private $merchant_no;

    /**
     * @var integer $encrypt_mode 加密方式 1 密钥模式 2 证书模式.
     */
    private $encrypt_mode;

    /**
     * @var string $certificate 证书.
     */
    private $certificate;

    /**
     * @var string $desc 充值说明 备注.
     */
    private $desc;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request Request.
     * @return mixed[]
     */
    public function toArray($request): array
    {
        unset($request);
        $userTags = UsersTag::whereIn('id', $this->tags->tag_id)->get(['id', 'title']);
        return [
                'id'              => $this->id,
                'platform_sign'   => $this->platform_sign,
                'frontend_name'   => $this->frontend_name,
                'frontend_remark' => $this->frontend_remark,
                'backend_name'    => $this->backend_name,
                'backend_remark'  => $this->backend_remark,
                'channel'         => [
                                      'id'   => $this->channel->id,
                                      'name' => $this->channel->name,
                                     ],
                'min_amount'      => (float) sprintf('%.2f', $this->min_amount),
                'max_amount'      => (float) sprintf('%.2f', $this->max_amount),
                'handle_fee'      => $this->handle_fee,
                'rebate_fee'      => $this->rebate_fee,
                'request_url'     => $this->request_url,
                'back_url'        => $this->back_url,
                'merchant_code'   => $this->merchant_code,
                'merchant_secret' => $this->merchant_secret,
                'public_key'      => $this->public_key,
                'private_key'     => $this->private_key,
                'app_id'          => $this->app_id,
                'vendor_url'      => $this->vendor_url,
                'level_ids'       => $this->level_ids,
                'status'          => $this->status,
                'sort'            => $this->sort,
                'auto_audit'      => (int) $this->auto_audit,
                'merchant_no'     => $this->merchant_no,
                'encrypt_mode'    => (int) $this->encrypt_mode,
                'certificate'     => $this->certificate,
                'desc'            => $this->desc,
                'tags'            => $userTags,
                'author'          => $this->author->name,
                'last_editor'     => $this->lastEditor->name ?? null,
                'updated_at'      => $this->updated_at->toDatetimeString(),
                'created_at'      => $this->created_at->toDatetimeString(),
               ];
    }
}
