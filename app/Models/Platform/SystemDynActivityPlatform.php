<?php

namespace App\Models\Platform;

use App\Models\Activity\SystemDynActivity;
use App\Models\Admin\MerchantAdminUser;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class SystemDynActivityPlatform
 *
 * @package App\Models\Platform
 */
class SystemDynActivityPlatform extends BaseModel
{

    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @return BelongsTo
     */
    public function activity(): BelongsTo
    {
        return $this->belongsTo(SystemDynActivity::class, 'activity_sign', 'sign');
    }

    /**
     * @return BelongsTo
     */
    public function lastEditor(): BelongsTo
    {
        return $this->belongsTo(MerchantAdminUser::class, 'last_editor_id', 'id');
    }
}
