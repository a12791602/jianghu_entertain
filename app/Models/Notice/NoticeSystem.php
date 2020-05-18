<?php

namespace App\Models\Notice;

use App\JHHYLibs\JHHYCnst;
use App\Models\Admin\MerchantAdminUser;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class NoticeSystem
 * @package App\Models\Notice
 */
class NoticeSystem extends BaseModel
{

    /**
     * @var mixed[]
     */
    protected $guarded = ['id'];

    /**
     * @return BelongsTo
     */
    public function lastEditor(): BelongsTo
    {
        return $this->belongsTo(MerchantAdminUser::class, 'last_editor_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(MerchantAdminUser::class, 'author_id', 'id');
    }

    /**
     * 设置device.
     *
     * @param array $value Value.
     * @return void
     */
    public function setDeviceAttribute(array $value): void
    {
        $device = [];
        if (array_key_exists('h5_pic', $value)) {
            $device[] = JHHYCnst::DEVICE_H5;
        } else {
            $this->attributes['h5_pic'] = '';
        }
        if (array_key_exists('app_pic', $value)) {
            $device[] = JHHYCnst::DEVICE_APP;
        } else {
            $this->attributes['app_pic'] = '';
        }
        if (array_key_exists('pc_pic', $value)) {
            $device[] = JHHYCnst::DEVICE_PC;
        } else {
            $this->attributes['pc_pic'] = '';
        }
        $device                     = json_encode($device);
        $this->attributes['device'] = $device;
    }

    /**
     * @param string $value Value.
     * @return mixed[]
     */
    public function getDeviceAttribute(string $value): array
    {
        $value = json_decode($value, true);
        if (empty($value)) {
            $value = [];
        }
        return $value;
    }
}
