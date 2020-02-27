<?php

namespace App\Models\DeveloperUsage\Backend;

use App\Models\BaseModel;
use App\Models\DeveloperUsage\Menu\BackendSystemMenu;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class SystemRoutesBackend
 * @package App\Models\DeveloperUsage\Backend
 */
class SystemRoutesBackend extends BaseModel
{

    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @var array
     */
    public static $fieldDefinition = [
                                      'id'            => '路由ID',
                                      'menu_group_id' => '所属菜单ID',
                                      'title'         => '标题',
                                      'route_name'    => '路由名称',
                                      'controller'    => '控制器',
                                      'method'        => '方法',
                                      'is_open'       => '开放状态',
                                     ];

    /**
     * @return BelongsTo
     */
    public function menu(): BelongsTo
    {
        $menu = $this->belongsTo(BackendSystemMenu::class, 'menu_group_id', 'id');
        return $menu;
    }
}
