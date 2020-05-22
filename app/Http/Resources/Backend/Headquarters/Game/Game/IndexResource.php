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
     * @var string $sign Sign.
     */
    private $sign;

    /**
     * @var string $status 管理员状态.
     */
    private $status;

    /**
     * @var App\Models\Systems\StaticResource $icon 游戏图标地址.
     */
    private $icon;

    /**
     * @var Carbon $created_at 管理员创建时间.
     */
    private $created_at;

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
     * @var \App\Models\Admin\BackendAdminUser $author BackendAdminUser.
     */
    private $author;

    /**
     * @var integer $request_mode Request_mode.
     */
    private $request_mode;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request Request.
     * @return mixed[]
     */
    public function toArray($request): array
    {
        unset($request);
        $icon = $this->icon->path ?? null;
        if ($icon) {
            $icon = config('image_domain.' . $this->app_environment) . $icon;
        }
        return [
                'id'           => $this->id,
                'vendor'       => [
                                   'id'   => $this->vendor->id,
                                   'name' => $this->vendor->name,
                                  ],
                'name'         => $this->name,
                'sign'         => $this->sign,
                'type'         => [
                                   'id'   => $this->type->id,
                                   'name' => $this->type->name,
                                  ],
                'sub_type'     => [
                                   'id'   => $this->subType->id,
                                   'name' => $this->subType->name,
                                  ],
                'icon'         => $icon,
                'status'       => $this->status,
                'request_mode' => $this->request_mode,
                'author'       => $this->author->name,
                'last_editor'  => $this->lastEditor->name ?? null,
                'created_at'   => $this->created_at->toDateTimeString(),
                'updated_at'   => $this->updated_at->toDateTimeString(),
               ];
    }
}
