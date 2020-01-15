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
     * @return BelongsTo
     */
    public function menu(): BelongsTo
    {
        $menu = $this->belongsTo(BackendSystemMenu::class, 'menu_group_id', 'id');
        return $menu;
    }
}
