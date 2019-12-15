<?php
namespace App\Http\SingleActions\Backend\Merchant\GameVendor;

use App\Models\Game\GameVendorPlatform;

/**
 * Class BaseAction
 * @package App\Http\SingleActions\Backend\Merchant\GameVendor
 */
class BaseAction
{
    /**
     * @var GameVendorPlatform
     */
    protected $model;

    /**
     * BaseAction constructor.
     * @param GameVendorPlatform $gameVendorPlatform
     */
    public function __construct(GameVendorPlatform $gameVendorPlatform)
    {
        $this->model = $gameVendorPlatform;
    }
}