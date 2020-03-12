<?php

namespace App\Models\Game;

use App\Lib\EloquentSortable\EloquentSortable;
use App\Lib\EloquentSortable\Sortable;
use App\ModelFilters\Game\GamesTypeFilter;
use App\Models\Admin\BackendAdminUser;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

/**
 * Class GamesType
 * @package App\Models\Game
 */
class GameType extends BaseModel implements Sortable
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

    /**
     * @var array
     */
    public static $fieldDefinition = [
                                      'name'      => '名称',
                                      'sign'      => '标记',
                                      'status'    => '金流分类状态',
                                      'parent_id' => '父级分类',
                                     ];

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
     * @return mixed
     */
    public function modelFilter()
    {
        $object = $this->provideFilter(GamesTypeFilter::class);
        return $object;
    }

    /**
     * @return HasManyThrough
     */
    public function games(): HasManyThrough
    {
        $game = $this->hasManyThrough(
            Game::class,
            GameVendor::class,
            'type_id', // Foreign key on vendor table with current table...
            'vendor_id', // Foreign key on target table with internal table...
            'id', // Local key on current table...
            'id', // Local key on internal table...
        );
        return $game;
    }

    /**
     * @return HasMany
     */
    public function children(): HasMany
    {
        $object = $this->hasMany(GameTypeChild::class, 'parent_id', 'id')->ordered();
        return $object;
    }
}
