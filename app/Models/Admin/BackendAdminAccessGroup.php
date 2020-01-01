<?php

namespace App\Models\Admin;

use App\Models\BaseModel;
use App\Models\DeveloperUsage\Backend\BackendAdminAccessGroupDetail;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class for backend admin access group.
 */
class BackendAdminAccessGroup extends BaseModel
{

    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Gets the table columns.
     *
     * @return mixed
     */
    public function getTableColumns()
    {
        $tableColumns = $this->getConnection()
                             ->getSchemaBuilder()
                             ->getColumnListing($this->getTable());
        return $tableColumns;
    }

    /**
     * @return HasMany
     */
    public function adminUsers(): HasMany
    {
        $adminUsers = $this->hasMany(BackendAdminUser::class, 'group_id', 'id');
        return $adminUsers;
    }

    /**
     * 管理员组权限
     *
     * @return HasMany
     */
    public function detail(): HasMany
    {
        $detail = $this->hasMany(BackendAdminAccessGroupDetail::class, 'group_id', 'id');
        return $detail;
    }
}
