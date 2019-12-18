<?php

namespace App\Models\Game;

use App\ModelFilters\Game\GameFilter;
use App\Models\Admin\BackendAdminUser;
use App\Models\BaseModel;

/**
 * Class Game
 * @package App\Models\Game
 */
class Game extends BaseModel
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
        $object = $this->belongsTo(BackendAdminUser::class, 'last_editor_id', 'id');
        return $object;
    }

    /**
     * @return mixed
     */
    public function author()
    {
        $object = $this->belongsTo(BackendAdminUser::class, 'author_id', 'id');
        return $object;
    }

    /**
     * @return mixed
     */
    public function vendor()
    {
        $object = $this->belongsTo(GamesVendor::class, 'vendor_id', 'id');
        return $object;
    }

    /**
     * @return mixed
     */
    public function type()
    {
        $object = $this->belongsTo(GamesType::class, 'type_id', 'id');
        return $object;
    }

    /**
     * @return mixed
     */
    public function modelFilter()
    {
        $object = $this->provideFilter(GameFilter::class);
        return $object;
    }
}
