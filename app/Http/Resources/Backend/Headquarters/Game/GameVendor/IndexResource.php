<?php

namespace App\Http\Resources\Backend\Headquarters\Game\GameVendor;

use App\Http\Resources\BaseResource;
use Carbon\Carbon;

/**
 * Class IndexResource
 * @package App\Http\Resources\Backend\Headquarters\Game\GameVendor
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
     * @var \App\Models\Systems\StaticResource $icon 游戏图标地址.
     */
    private $icon;

    /**
     * @var string $sort 排序.
     */
    private $sort;

    /**
     * @var array $production 正式站.
     */
    private $production;

    /**
     * @var array $staging 测试站.
     */
    private $staging;

    /**
     * @var Carbon $created_at 管理员创建时间.
     */
    private $created_at;

    /**
     * @var Carbon $updated_at 管理员创建时间.
     */
    private $updated_at;

    /**
     * @var \App\Models\Game\GameType $gameType GameType.
     */
    private $gameType;

    /**
     * @var \App\Models\Admin\BackendAdminUser $lastEditor BackendAdminUser.
     */
    private $lastEditor;

    /**
     * @var \App\Models\Admin\BackendAdminUser $author BackendAdminUser.
     */
    private $author;

    /**
     * @var \App\Models\Systems\SystemIpWhiteList $whiteList SystemIpWhiteList.
     */
    private $whiteList;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request Request.
     * @return mixed[]
     */
    public function toArray($request): array
    {
        unset($request);
        $icon = $this->icon->path;
        if ($icon) {
            $icon = config('image_domain.' . $this->app_environment) . $icon;
        }
        return [
                'id'             => $this->id,
                'name'           => $this->name,
                'icon'           => $icon,
                'sort'           => $this->sort,
                'type'           => $this->gameType->name,
                'status'         => $this->status,
                'production'     => $this->production,
                'staging'        => $this->staging,
                'author'         => $this->author->name,
                'last_editor'    => $this->lastEditor->name ?? null,
                'white_list'     => $this->whiteList->ips ?? null,
                'created_at'     => $this->created_at->toDateTimeString(),
                'updated_at'     => $this->updated_at->toDateTimeString(),
               ];
    }
}
