<?php

namespace App\Models\Game;

use App\ModelFilters\Game\GameFilter;
use App\Models\Admin\BackendAdminUser;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Request;

/**
 * Class Game
 * @package App\Models\Game
 */
class Game extends BaseModel
{
    
    public const STATUS_CLOSE = 0;
    public const STATUS_OPEN  = 1;

    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['url'];

    /**
     * @var array
     */
    public static $fieldDefinition = [
                                      'name'         => '游戏名称',
                                      'sign'         => '标记',
                                      'status'       => '游戏状态',
                                      'type_id'      => '游戏分类ID',
                                      'sub_type_id'  => '游戏子分类ID',
                                      'vendor_id'    => '所属厂商ID',
                                      'request_mode' => '请求方式',
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
     * @return BelongsTo
     */
    public function vendor(): BelongsTo
    {
        $object = $this->belongsTo(GameVendor::class, 'vendor_id', 'id');
        return $object;
    }

    /**
     * @return BelongsTo
     */
    public function type(): BelongsTo
    {
        $object = $this->belongsTo(GameType::class, 'type_id', 'id');
        return $object;
    }

    /**
     * @return BelongsTo
     */
    public function subType(): BelongsTo
    {
        $object = $this->belongsTo(GameSubType::class, 'sub_type_id', 'id');
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

    /**
     * 游戏路径
     * @return string
     */
    public function getUrlAttribute(): string
    {
        $prefix = Request::get('prefix');
        $result = '/' . $prefix . '/games-lobby/in-game/' . $this->type_id . '/' . $this->sub_type_id . '/' . $this->id;
        return $result;
    }
}
