<?php

namespace App\Models\DeveloperUsage\Merchant;

use App\Models\BaseModel;
use App\Models\DeveloperUsage\Menu\MerchantSystemMenu;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Route;

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
    protected $appends = [
                          'real_route',
                          'route_to_update',
                         ];

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
     * @return string
     */
    public function getRealRouteAttribute(): string
    {
        if (!Route::has($this->route_name)) {
            return '';
        }
        return route($this->route_name, [], false);
    }

    /**
     * @return integer
     */
    public function getRouteToUpdateAttribute(): int
    {
        if (!Route::has($this->route_name)) {
            return 1;
        }
        return 0;
    }

    /**
     * @return BelongsTo
     */
    public function menu(): BelongsTo
    {
        return $this->belongsTo(MerchantSystemMenu::class, 'menu_group_id', 'id');
    }
}
