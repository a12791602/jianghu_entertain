<?php

namespace App\Models\Game;

use App\ModelFilters\Game\GamesVendorFilter;
use App\Models\Admin\BackendAdminUser;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class GameVendor
 * @package App\Models\Game
 */
class GameVendor extends BaseModel
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

    /**
     * @param string|null $value Value.
     * @return mixed[]|null
     */
    public function getWhitelistIpsAttribute(?string $value): ?array
    {
        if (!empty($value)) {
            $value = json_decode($value, true);
        }
        return $value;
    }

    /**
     * @return mixed
     */
    public function modelFilter()
    {
        $object = $this->provideFilter(GamesVendorFilter::class);
        return $object;
    }
}
