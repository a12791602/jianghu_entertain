<?php

namespace App\Models\Systems;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class SystemConfiguration
 * @package App\Models\Systems
 */
class SystemConfiguration extends BaseModel
{

    public const DISPLAY_NO  = 0;
    public const DISPLAY_YES = 1;

    /**
     * @var array $guarded
     */
    protected $guarded = ['id'];

    /**
     * @var array
     */
    public static $fieldDefinition = ['sign' => '配置标识'];

    /**
     * 下级
     * @return HasMany
     */
    public function childs(): HasMany
    {
        return $this->hasMany($this, 'pid', 'id');
    }
}
