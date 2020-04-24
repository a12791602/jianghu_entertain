<?php

namespace App\Models\Finance;

use App\Models\Admin\BackendAdminUser;
use App\Models\FilterModel;
use App\Models\Systems\SystemIpWhiteList;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class SystemFinanceVendor
 * @package App\Models\Finance
 */
class SystemFinanceVendor extends FilterModel
{

    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @var array
     */
    public static $fieldDefinition = [
                                      'name'          => '厂商名称',
                                      'sign'          => '厂商标识',
                                      'type_id'       => '游戏类型id',
                                      'whitelist_ips' => '白名单',
                                      'status'        => '厂商状态',
                                     ];

    /**
     * @return BelongsTo
     */
    public function lastEditor(): BelongsTo
    {
        return $this->belongsTo(BackendAdminUser::class, 'last_editor_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(BackendAdminUser::class, 'author_id', 'id');
    }

    /**
     * @return HasOne
     */
    public function whiteList(): HasOne
    {
        return $this->hasOne(SystemIpWhiteList::class, 'finance_vendor_id', 'id');
    }

    /**
     * @param array $value Value.
     * @return void
     */
    public function setWhitelistIpsAttribute(array $value): void
    {
        if (!empty($value)) {
            $this->attributes['whitelist_ips'] = json_encode($value);
        } else {
            $this->attributes['whitelist_ips'] = null;
        }
    }
}
