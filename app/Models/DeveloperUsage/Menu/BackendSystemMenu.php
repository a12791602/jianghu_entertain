<?php

namespace App\Models\DeveloperUsage\Menu;

use App\Models\BaseModel;
use App\Models\DeveloperUsage\Menu\Traits\MenuLogics;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class for backend system menu.
 */
class BackendSystemMenu extends BaseModel
{
    use MenuLogics;

    /**
     * RedisKey
     */
    public const ALL_MENU_REDIS_KEY = '1';
    
    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @var string
     */
    protected $redisFirstTag = 'ms_menu';

    /**
     * @return HasMany
     */
    public function childs(): HasMany
    {
        $childs = $this->hasMany(BackendSystemMenu::class, 'pid', 'id');
        return $childs;
    }
}
