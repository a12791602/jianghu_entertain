<?php

namespace App\Models\Game;

use App\Lib\EloquentSortable\EloquentSortable;
use App\Lib\EloquentSortable\Sortable;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class GameSubType
 * @package App\Models\Game
 */
class GameSubType extends BaseModel implements Sortable
{
    use EloquentSortable;// Eloquent Sortable.
    
    public const STATUS_CLOSE = 0;
    public const STATUS_OPEN  = 1;

    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Order column name
     * @var array
     */
    public $sortable = ['order_column_name' => 'sort'];

    /**
     * @return hasMany
     */
    public function games(): HasMany
    {
        return $this->hasMany(Game::class, 'sub_type_id', 'id');
    }
}
