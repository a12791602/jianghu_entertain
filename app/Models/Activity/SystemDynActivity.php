<?php

namespace App\Models\Activity;

use App\Models\Admin\BackendAdminUser;
use App\Models\BaseModel;

/**
 * Class SystemDynActivity
 *
 * @package App\Models\Activity
 */
class SystemDynActivity extends BaseModel
{

    /**
     * @var array $guarded
     */
    protected $guarded = ['id'];


    /**
     * @param  integer $value Value.
     * @return string
     */
    public function getLastEditorIdAttribute(int $value): string
    {
        if (!empty($value)) {
            $name = BackendAdminUser::find($value)->name;
            return $name;
        }
        return '';
    }
}
