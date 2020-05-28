<?php

namespace App\Http\Resources\Backend\Merchant\Activity\Statically;

use App\Http\Resources\BaseResource;
use App\Models\Admin\MerchantAdminUser;
use App\Models\Systems\StaticResource;
use Carbon\Carbon;

/**
 * Class IndexResource
 * @package App\Http\Resources\Backend\Merchant\Activity\Statically
 */
class IndexResource extends BaseResource
{

    /**
     * @var integer $id Id.
     */
    private $id;

    /**
     * @var StaticResource $picture 活动图片地址.
     */
    private $picture;

    /**
     * @var integer $pic_id 活动图片id.
     */
    private $pic_id;

    /**
     * @var string $start_time Start_time.
     */
    private $start_time;

    /**
     * @var string $end_time End_time.
     */
    private $end_time;

    /**
     * @var integer $status 状态
     */
    private $status;

    /**
     * @var MerchantAdminUser $author MerchantAdminUser.
     */
    private $author;

    /**
     * @var MerchantAdminUser $lastEditor MerchantAdminUser.
     */
    private $lastEditor;

    /**
     * @var Carbon $created_at 创建时间.
     */
    private $created_at;

    /**
     * @var Carbon $updated_at 更新时间.
     */
    private $updated_at;

    /**
     * @var integer $platform_id Platform_id.
     */
    private $platform_id;

    /**
     * @var integer $device Device.
     */
    private $device;

    /**
     * @var string $title Title.
     */
    private $title;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request Request.
     * @return mixed[]
     */
    public function toArray($request): array
    {
        unset($request);
        $picture = $this->picture->path ?? null;
        if ($picture) {
            $picture = config('image_domain.' . $this->app_environment) . $picture;
        }
        return [
                'id'          => $this->id,
                'pic_id'      => $this->pic_id,
                'picture'     => $picture,
                'title'       => $this->title,
                'device'      => $this->device,
                'platform_id' => $this->platform_id,
                'start_time'  => $this->start_time,
                'end_time'    => $this->end_time,
                'status'      => $this->status,
                'author'      => $this->author->name,
                'last_editor' => $this->lastEditor->name ?? null,
                'created_at'  => $this->created_at->toDateTimeString(),
                'updated_at'  => $this->updated_at->toDateTimeString(),
               ];
    }
}
