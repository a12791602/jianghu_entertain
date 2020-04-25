<?php

namespace App\Models\Systems;

use App\Models\Admin\MerchantAdminUser;
use App\Models\BaseModel;
use App\Models\Game\Game;
use App\Models\Game\GameType;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * 代理平台
 */
class SystemPlatform extends BaseModel
{

    public const STATUS_OPEN = 1;

    public const STATUS_CLOSE = 0;

    /**
     * @var array $guarded
     */
    protected $guarded = ['id'];

    /**
     * @var array
     */
    public static $fieldDefinition = [
                                      'id'             => '平台ID',
                                      'agency_method'  => '代理方式',
                                      'pc_skin_id'     => 'PC皮肤',
                                      'h5_skin_id'     => 'H5皮肤',
                                      'app_skin_id'    => 'APP皮肤',
                                      'maintain_start' => '维护开始时间',
                                      'maintain_end'   => '维护结束时间',
                                     ];

    /**
     * @return HasMany
     */
    public function adminUsers(): HasMany
    {
        return $this->hasMany(MerchantAdminUser::class, 'platform_sign', 'sign');
    }

    /**
     * 平台所属人
     * @return HasOne
     */
    public function owner(): HasOne
    {
        return $this->hasOne(MerchantAdminUser::class, 'id', 'owner_id');
    }

    /**
     * 平台SSL证书
     * @return HasOne
     */
    public function sslKey(): HasOne
    {
        return $this->hasOne(SystemPlatformSsl::class, 'platform_sign', 'sign');
    }

    /**
     * The games types that belong to the platforms.
     *
     * @return BelongsToMany
     */
    public function gameTypes(): BelongsToMany
    {
        return $this->belongsToMany(
            GameType::class,
            'game_type_platforms',
            'platform_id',
            'type_id',
        );
    }

    /**
     * platforms has games distrubed
     *
     * @return BelongsToMany
     */
    public function games(): BelongsToMany
    {
        return $this->belongsToMany(
            Game::class,
            'game_platforms',
            'platform_id',
            'game_id',
        );
    }
}
