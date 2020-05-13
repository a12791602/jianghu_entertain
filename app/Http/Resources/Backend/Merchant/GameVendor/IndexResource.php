<?php

namespace App\Http\Resources\Backend\Merchant\GameVendor;

use App;
use App\Http\Resources\BaseResource;
use App\Models\Game\Game;

/**
 * Class IndexResource
 * @package App\Http\Resources\Backend\Merchant\Game
 */
class IndexResource extends BaseResource
{

    /**
     * @var integer $id Id.
     */
    private $id;

    /**
     * @var App\Models\Game\GameVendor $gameVendor GameVendor Model.
     */
    private $gameVendor;

    /**
     * @var integer $sort Sort.
     */
    private $sort;

    /**
     * @var integer $status Status.
     */
    private $status;

    /**
     * @var App\Models\Systems\StaticResource $icon 游戏图标地址.
     */
    private $icon;

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
                'id'     => $this->id,
                'icon'   => $icon,
                'name'   => $this->gameVendor->name,
                'sort'   => $this->sort,
                'status' => $this->status,
               ];
    }
}
