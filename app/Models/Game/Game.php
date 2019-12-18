<?php

namespace App\Models\Game;

use App\ModelFilters\Game\GameFilter;
use App\Models\Admin\BackendAdminUser;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
     * @return BelongsTo
     */
    public function vendor(): BelongsTo
    {
        $object = $this->belongsTo(GamesVendor::class, 'vendor_id', 'id');
        return $object;
    }

    /**
     * @return BelongsTo
     */
    public function type(): BelongsTo
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
