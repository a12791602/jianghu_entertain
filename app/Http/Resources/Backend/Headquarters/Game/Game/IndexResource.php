<?php

namespace App\Http\Resources\Backend\Headquarters\Game\Game;

use App;
use App\Http\Resources\BaseResource;
use Carbon\Carbon;

/**
 * Class IndexResource
 * @package App\Http\Resources\Backend\Headquarters\Game\GameType
 */
class IndexResource extends BaseResource
{

    /**
     * @var integer $id 管理员Id.
     */
    private $id;

    /**
     * @var string $name 管理员名称.
     */
    private $name;

    /**
     * @var string $status 管理员状态.
     */
    private $status;

    /**
     * @var App\Models\Systems\StaticResource $icon 游戏图标地址.
     */
    private $icon;

    /**
     * @var Carbon $updated_at 管理员创建时间.
     */
    private $updated_at;

    /**
     * @var App\Models\Game\GameType $type GameType.
     */
    private $type;

    /**
     * @var App\Models\Game\GameSubType $subType GameType.
     */
    private $subType;

    /**
     * @var App\Models\Admin\BackendAdminUser $lastEditor BackendAdminUser.
     */
    private $lastEditor;

    /**
     * @var App\Models\Game\GameVendor $vendor GameVendor.
     */
    private $vendor;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request Request.
     * @return mixed[]
     */
    public function toArray($request): array
    {
        $icon = $this->icon->path ?? null;
        unset($request);
        return [
                'id'          => $this->id,
                'vendor_name' => $this->vendor->name,
                'name'        => $this->name,
                'type'        => $this->type->name,
                'sub_type'    => $this->subType->name,
                'icon'        => config('image_domain.' . $this->app_environment) . $icon,
                'status'      => $this->status,
                'last_editor' => $this->lastEditor->name ?? null,
                'updated_at'  => $this->updated_at->toDateTimeString(),
               ];
    }
}
