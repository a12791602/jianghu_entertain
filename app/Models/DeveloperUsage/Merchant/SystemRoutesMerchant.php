<?php

namespace App\Models\DeveloperUsage\Merchant;

use App\Models\BaseModel;
use App\Models\DeveloperUsage\Menu\MerchantSystemMenu;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class for system routes merchant.
 */
class SystemRoutesMerchant extends BaseModel
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
        $menu = $this->belongsTo(MerchantSystemMenu::class, 'menu_group_id', 'id');
        return $menu;
    }
}
