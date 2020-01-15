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
     * @return BelongsTo
     */
    public function menu(): BelongsTo
    {
        $menu = $this->belongsTo(MerchantSystemMenu::class, 'menu_group_id', 'id');
        return $menu;
    }
}
