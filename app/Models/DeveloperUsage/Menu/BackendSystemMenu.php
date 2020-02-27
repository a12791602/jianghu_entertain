<?php

namespace App\Models\DeveloperUsage\Menu;

use App\Models\BaseModel;
use App\Models\DeveloperUsage\Menu\Logics\MenuLogics;
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
     * @var array
     */
    public static $fieldDefinition = [
                                      'id'      => '菜单ID',
                                      'label'   => '菜单名称',
                                      'en_name' => '菜单英文名称',
                                      'route'   => '路由',
                                      'icon'    => '图标',
                                      'pid'     => '上级ID',
                                      'sort'    => '排序',
                                      'level'   => '层级',
                                      'display' => '显示状态',
                                     ];

    /**
     * @return HasMany
     */
    public function childs(): HasMany
    {
        $childs = $this->hasMany(BackendSystemMenu::class, 'pid', 'id');
        return $childs;
    }
}
