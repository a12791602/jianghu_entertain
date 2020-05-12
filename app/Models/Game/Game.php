<?php

namespace App\Models\Game;

use App\Models\Admin\BackendAdminUser;
use App\Models\BaseModel;
use App\Models\Systems\StaticResource;
use App\Models\User\Logics\GameLogics;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Request;

/**
 * Class Game
 * @package App\Models\Game
 */
class Game extends BaseModel
{
    use GameLogics;

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
                                      'platform_id'  => '平台ID',
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
     * @return BelongsTo
     */
    public function vendor(): BelongsTo
    {
        return $this->belongsTo(GameVendor::class, 'vendor_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(GameType::class, 'type_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function subType(): BelongsTo
    {
        return $this->belongsTo(GameSubType::class, 'sub_type_id', 'id');
    }

    /**
     * 游戏路径
     * @return string
     */
    public function getUrlAttribute(): string
    {
        $prefix = Request::get('prefix');
        return '/' . $prefix . '/games-lobby/in-game/' . $this->type_id . '/' . $this->sub_type_id . '/' . $this->id;
    }


    /**
     * Game icon.
     * @return HasOne
     */
    public function icon(): HasOne
    {
        return $this->hasOne(StaticResource::class, 'id', 'icon_id');
    }
}
