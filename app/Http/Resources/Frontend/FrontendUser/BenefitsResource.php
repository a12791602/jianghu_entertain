<?php

namespace App\Http\Resources\Frontend\FrontendUser;

use App\Http\Resources\Frontend\System\SystemLevelResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class BenefitsResource
 * @package App\Http\Resources\Frontend\FrontendUser
 */
class BenefitsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request $request Request.
     * @return mixed[]
     */
    public function toArray($request): array
    {
        $result = [
                   'system_level'          => SystemLevelResource::collection($this['system_level']),
                   'level_benefits_status' => LevelGiftResource::collection($this['level_benefits']),
                  ];
        return $result;
    }
}
