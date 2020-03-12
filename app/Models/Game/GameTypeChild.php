<?php

namespace App\Models\Game;

use App\Lib\EloquentSortable\EloquentSortable;
use App\Lib\EloquentSortable\Sortable;
use App\Models\BaseModel;

/**
 * Class GameTypeChild
 * @package App\Models\Game
 */
class GameTypeChild extends BaseModel implements Sortable
{
    use EloquentSortable;// Eloquent Sortable.

    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Order column name
     * @var array
     */
    public $sortable = ['order_column_name' => 'sort'];
}
