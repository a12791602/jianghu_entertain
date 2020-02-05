<?php
namespace App\Http\SingleActions\Backend\Merchant\GameVendor;

use App\Http\SingleActions\MainAction;
use App\Models\Game\GameVendorPlatform;
use Illuminate\Http\Request;

/**
 * Class MainAction
 * @package App\Http\SingleActions\Backend\Merchant\GameVendor
 */
class BaseAction extends MainAction
{
    /**
     * @var GameVendorPlatform
     */
    protected $model;

     /**
      * MainAction constructor.
      * @param GameVendorPlatform $gameVendorPlatform GameVendorPlatform.
      * @param Request            $request            Request
      * @throws \Exception Exception.
      */
    public function __construct(GameVendorPlatform $gameVendorPlatform, Request $request)
    {
        parent::__construct($request);
        $this->model = $gameVendorPlatform;
    }
}