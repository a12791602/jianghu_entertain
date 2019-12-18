<?php

namespace App\Models\Game;

use App\ModelFilters\Game\GamesVendorFilter;
use App\Models\Admin\BackendAdminUser;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class GamesVendor
 * @package App\Models\Game
 */
class GamesVendor extends BaseModel
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
     * @return false|string
     */
    public function setWhitelistIpsAttribute(array $value)
    {
        if (!empty($value)) {
            $value = json_encode($value);
            return $value;
        }
        return '';
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
