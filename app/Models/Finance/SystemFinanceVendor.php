<?php

namespace App\Models\Finance;

use App\Models\Admin\BackendAdminUser;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class SystemFinanceVendor
 * @package App\Models\Finance
 */
class SystemFinanceVendor extends BaseModel
{

    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @return BelongsTo
     */
    public function lastEditor(): BelongsTo
    {
        $object = $this->belongsTo(BackendAdminUser::class, 'last_editor_id', 'id');
        return $object;
    }

    /**
     * @return BelongsTo
     */
    public function author(): BelongsTo
    {
        $object = $this->belongsTo(BackendAdminUser::class, 'author_id', 'id');
        return $object;
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
