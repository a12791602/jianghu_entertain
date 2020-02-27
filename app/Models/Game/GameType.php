<?php

namespace App\Models\Game;

use App\ModelFilters\Game\GamesTypeFilter;
use App\Models\Admin\BackendAdminUser;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

/**
 * Class GamesType
 * @package App\Models\Game
 */
class GameType extends BaseModel
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
}
