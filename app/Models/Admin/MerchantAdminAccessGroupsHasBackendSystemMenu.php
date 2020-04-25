<?php

namespace App\Models\Admin;

use App\Models\FilterModel;

/**
 * Class for merchant admin access groups has backend system menu.
 */
class MerchantAdminAccessGroupsHasBackendSystemMenu extends FilterModel
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];
}
