<?php

namespace App\Models\Systems;

use App\Models\Admin\MerchantAdminUser;
use App\Models\BaseModel;
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
     * @return HasMany
     */
    public function adminUsers(): HasMany
    {
        $adminUsers = $this->hasMany(MerchantAdminUser::class, 'platform_sign', 'sign');
        return $adminUsers;
    }

    /**
     * 平台所属人
     * @return HasOne
     */
    public function owner(): HasOne
    {
        $owner = $this->hasOne(MerchantAdminUser::class, 'id', 'owner_id');
        return $owner;
    }

    /**
     * 平台SSL证书
     * @return HasOne
     */
    public function sslKey(): HasOne
    {
        $sslKey = $this->hasOne(SystemPlatformSsl::class, 'platform_sign', 'sign');
        return $sslKey;
    }

    /**
     * The games types that belong to the platforms.
     *
     * @return BelongsToMany
     */
    public function gameTypes(): BelongsToMany
    {
        $gameTypes = $this->belongsToMany(
            GameType::class,
            'game_type_platforms',
            'platform_id',
            'type_id',
        );
        return $gameTypes;
    }
}
