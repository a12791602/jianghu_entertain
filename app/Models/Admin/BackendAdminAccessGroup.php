<?php

namespace App\Models\Admin;

use App\Models\DeveloperUsage\Backend\BackendAdminAccessGroupDetail;
use App\Models\FilterModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class for backend admin access group.
 */
class BackendAdminAccessGroup extends FilterModel
{

    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @var array
     */
    public static $fieldDefinition = [
                                      'id'         => '管理员组ID',
                                      'group_name' => '管理员组名称',
                                     ];

    /**
     * Gets the table columns.
     *
     * @return mixed
     */
    public function getTableColumns()
    {
        return $this->getConnection()
                             ->getSchemaBuilder()
                             ->getColumnListing($this->getTable());
    }

    /**
     * @return HasMany
     */
    public function adminUsers(): HasMany
    {
        return $this->hasMany(BackendAdminUser::class, 'group_id', 'id');
    }

    /**
     * 管理员组权限
     *
     * @return HasMany
     */
    public function detail(): HasMany
    {
        return $this->hasMany(BackendAdminAccessGroupDetail::class, 'group_id', 'id');
    }
}
