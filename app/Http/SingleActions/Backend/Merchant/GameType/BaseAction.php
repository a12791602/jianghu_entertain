<?php

namespace App\Http\SingleActions\Backend\Merchant\GameType;

use App\Http\SingleActions\MainAction;
use App\Models\Game\GameTypePlatform;
use Illuminate\Http\Request;

/**
 * Class MainAction
 * @package App\Http\SingleActions\Backend\Merchant\GameType
 */
class BaseAction extends MainAction
{

    /**
     * @var GameTypePlatform
     */
    protected $model;

     /**
      * MainAction constructor.
      * @param GameTypePlatform $gameTypePlatform GameTypePlatform.
      * @param Request          $request          Request.
      * @throws \Exception Exception.
      */
    public function __construct(GameTypePlatform $gameTypePlatform, Request $request)
    {
        parent::__construct($request);
        $this->model = $gameTypePlatform;
    }
}
