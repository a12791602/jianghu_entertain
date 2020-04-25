<?php

namespace App\Models\Game;

use App\Lib\EloquentSortable\EloquentSortable;
use App\Lib\EloquentSortable\Sortable;
use App\Models\Admin\BackendAdminUser;
use App\Models\FilterModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

/**
 * Class GamesType
 * @package App\Models\Game
 */
class GameType extends FilterModel implements Sortable
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
     * @var array
     */
    public static $fieldDefinition = [
                                      'name'   => '名称',
                                      'sign'   => '标记',
                                      'status' => '分类状态',
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
     * @return HasManyThrough
     */
    public function games(): HasManyThrough
    {
        return $this->hasManyThrough(
            Game::class,
            GameVendor::class,
            'type_id', // Foreign key on vendor table with current table...
            'vendor_id', // Foreign key on target table with internal table...
            'id', // Local key on current table...
            'id', // Local key on internal table...
        );
    }

    /**
     * @return HasMany
     */
    public function children(): HasMany
    {
        return $this->hasMany(GameSubType::class, 'parent_id', 'id')->ordered();
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot(): void
    {
        parent::boot();
        static::deleting(
            static function ($model): void {
                $model->children()->delete();
            },
        );
    }
}
