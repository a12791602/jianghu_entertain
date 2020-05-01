<?php

namespace App\Http\Resources\Backend\Headquarters\Merchant\Platform;

use App\Http\Resources\BaseResource;

/**
 * Class AssignedGameResource
 * @package App\Http\Resources\Backend\Headquarters\Merchant\Platform
 */
class AssignedGameResource extends BaseResource
{

    /**
     * Game Model
     * @var \App\Models\Game\Game $games Game Model.
     */
    private $games;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request Request.
     * @return mixed[]
     */
    public function toArray($request): array
    {
        unset($request);
        return [
                'id'        => $this->games->id,
                'name'      => $this->games->name,
                'sign'      => $this->games->sign,
                'vendor_id' => $this->games->vendor_id,
               ];
    }
}
