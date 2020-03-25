<?php

namespace App\Http\Resources\Backend\Merchant\Finance\Offline;

use App\Http\Resources\BaseResource;
use App\Models\Admin\MerchantAdminUser;
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
     * @var string $platform_id 平台ID.
     */
    private $platform_id;

    /**
     * @var string $bank 银行信息.
     */
    private $bank;

    /**
     * @var string $name 收款名称.
     */
    private $name;

    /**
     * @var string $remark 备注.
     */
    private $remark;

    /**
     * @var string $qrcode 二维码.
     */
    private $qrcode;

    /**
     * @var string $account 账户.
     */
    private $account;

    /**
     * @var string $username 收款姓名.
     */
    private $username;

    /**
     * @var float $min_amount 最低入款.
     */
    private $min_amount;

    /**
     * @var float $max_amount 最高入款.
     */
    private $max_amount;

    /**
     * @var integer $sort 排序.
     */
    private $sort;

    /**
     * @var integer $status 状态.
     */
    private $status;

    /**
     * @var string $branch 支行.
     */
    private $branch;

    /**
     * @var SystemFinanceType $type 转账类型.
     */
    private $type;

    /**
     * @var MerchantAdminUser $author 创建人.
     */
    private $author;

    /**
     * @var MerchantAdminUser $lastEditor 最近一次编辑人.
     */
    private $lastEditor;

    /**
     * @var float $fee_cost 手续费.
     */
    private $fee_cost;

    /**
     * @var Carbon $updated_at Updated_at.
     */
    private $updated_at;

    /**
     * @var Carbon $created_at Created_at.
     */
    private $created_at;

    /**
     * @var SystemFinanceUserTag $tags 会员标签.
     */
    private $tags;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request Request.
     * @return mixed[]
     */
    public function toArray($request): array
    {
        $userTags = UsersTag::whereIn('id', $this->tags->tag_id)->get(['id', 'title']);

        $result = [
                   'id'          => $this->id,
                   'type'        => $this->type->name,
                   'platform_id' => $this->platform_id,
                   'bank'        => optional($this->bank)->name,
                   'name'        => $this->name,
                   'remark'      => $this->remark,
                   'qrcode'      => $this->qrcode,
                   'account'     => $this->account,
                   'username'    => $this->username,
                   'min_amount'  => (float) sprintf('%.2f', $this->min_amount),
                   'max_amount'  => (float) sprintf('%.2f', $this->max_amount),
                   'sort'        => (int) $this->sort,
                   'status'      => (int) $this->status,
                   'branch'      => $this->branch,
                   'author'      => $this->author->name,
                   'last_editor' => $this->lastEditor->name,
                   'fee_cost'    => (float) $this->fee_cost,
                   'tags'        => $userTags,
                   'updated_at'  => $this->updated_at->toDatetimeString(),
                   'created_at'  => $this->created_at->toDatetimeString(),
                  ];
        return $result;
    }
}
