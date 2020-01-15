<?php

namespace App\Models\DeveloperUsage\Menu;

use App\Models\BaseModel;
use App\Models\DeveloperUsage\Menu\Traits\MerchantMenuLogics;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class for merchant system menu.
 */
class MerchantSystemMenu extends BaseModel
{
    use MerchantMenuLogics;

    /**
     * RedisKey
     */
    public const ALL_MENU_REDIS_KEY = '*';

    /**
     * @var string
     */
    protected $redisFirstTag = 'merchant_menu';

    /**
     * @return HasMany
     */
    public function childs(): HasMany
    {
        $childs = $this->hasMany(MerchantSystemMenu::class, 'pid', 'id');
        return $childs;
    }
}
