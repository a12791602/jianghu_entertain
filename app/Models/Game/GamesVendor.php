<?php

namespace App\Models\Game;

use App\ModelFilters\Game\GamesVendorFilter;
use App\Models\Admin\BackendAdminUser;
use App\Models\BaseModel;

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
     * @return mixed
     */
    public function lastEditor()
    {
        return $this->belongsTo(BackendAdminUser::class, 'last_editor_id', 'id');
    }

    /**
     * @return mixed
     */
    public function author()
    {
        return $this->belongsTo(BackendAdminUser::class, 'author_id', 'id');
    }

    /**
     * @param array $value Value.
     * @return false|string
     */
    public function setWhitelistIpsAttribute(array $value)
    {
        if (!empty($value)) {
            return json_encode($value);
        }
        return '';
    }

    /**
     * @return mixed
     */
    public function modelFilter()
    {
        return $this->provideFilter(GamesVendorFilter::class);
    }
}
