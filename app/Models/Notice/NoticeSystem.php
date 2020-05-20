<?php

namespace App\Models\Notice;

use App\Lib\Constant\JHHYCnst;
use App\Models\Admin\MerchantAdminUser;
use App\Models\BaseModel;
use App\Models\Systems\StaticResource;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Arr;

/**
 * Class NoticeSystem
 * @package App\Models\Notice
 */
class NoticeSystem extends BaseModel
{

    protected const PIC_CRITERIAS = [
                                     'h5_pic_id'  => JHHYCnst::DEVICE_H5,
                                     'app_pic_id' => JHHYCnst::DEVICE_APP,
                                     'pc_pic_id'  => JHHYCnst::DEVICE_PC,
                                    ];

    /**
     * @var mixed[]
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['device' => 'array'];

    /**
     * @var array
     */
    public static $fieldDefinition = [
                                      'id'         => '系统公告id',
                                      'title'      => '系统公告标题',
                                      'h5_pic_id'  => 'h5系统公告图片id',
                                      'app_pic_id' => 'app系统公告图片id',
                                      'pc_pic_id'  => 'pc系统公告图片id',
                                      'device'     => '系统公告展示设备',
                                      'status'     => '系统公告使用状态',
                                      'start_time' => '开始时间',
                                      'end_time'   => '结束时间',
                                     ];

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
     * 获取设备数据保存之前 以后要 调整这些接口设计不统一的 暂时把泰博的接口 能调通
     * @param array $data Input.
     * @return array<int,int>
     */
    public function getDevice(array $data): array
    {
        $device = [];
        foreach (self::PIC_CRITERIAS as $criKey => $criVal) {
            $exist = Arr::exists($data, $criKey);
            if (!$exist) {
                continue;
            }
            $device[] = $criVal;
        }
        return $device;
    }

    /**
     * @param array|null $inputDatas Input.
     * @return boolean
     */
    public function cleanResource(?array $inputDatas): bool
    {
        foreach (self::PIC_CRITERIAS as $criKey => $criVal) {
            unset($criVal);
            //编辑的时候
            if ($inputDatas !== null) {
                $hasValue = $this->$criKey !== null && isset($inputDatas[$criKey]);
                if (!$hasValue || $this->$criKey === $inputDatas[$criKey]) {
                    continue;
                }
            } else {
                //删除的时候
                $hasValue = $this->$criKey !== null;
                if (!$hasValue) {
                    continue;
                }
            }
            StaticResource::resourceClean($this->$criKey);
        }
        return true;
    }

    /**
     * Get H5 Pic
     *
     * @return string
     */
    public function getH5PicAttribute(): string
    {
        $result = $this->getPicPath($this->h5PicPath);
        unset($this->h5PicPath);
        return $result;
    }

    /**
     * Get App Pic
     *
     * @return string
     */
    public function getAppPicAttribute(): string
    {
        $result = $this->getPicPath($this->appPicPath);
        unset($this->appPicPath);
        return $result;
    }

    /**
     * Get Pc Pic
     *
     * @return string
     */
    public function getPcPicAttribute(): string
    {
        $result = $this->getPicPath($this->pcPicPath);
        unset($this->pcPicPath);
        return $result;
    }

    /**
     * @param StaticResource|null $eloqPath EloqPath.
     * @return boolean|mixed
     */
    protected function getPicPath(?StaticResource $eloqPath)
    {
        if ($eloqPath instanceof StaticResource) {
            return getJHHYUrl($eloqPath->path, 'resources');
        }
        return false;
    }

    /**
     * Banner PicPath.
     * @return HasOne
     */
    public function h5PicPath(): HasOne
    {
        return $this->hasOne(StaticResource::class, 'id', 'h5_pic_id');
    }

    /**
     * Banner PicPath.
     * @return HasOne
     */
    public function appPicPath(): HasOne
    {
        return $this->hasOne(StaticResource::class, 'id', 'app_pic_id');
    }

    /**
     * Banner PicPath.
     * @return HasOne
     */
    public function pcPicPath(): HasOne
    {
        return $this->hasOne(StaticResource::class, 'id', 'pc_pic_id');
    }
}
