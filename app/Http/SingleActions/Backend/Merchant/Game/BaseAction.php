<?php

namespace App\Http\SingleActions\Backend\Merchant\Game;

use App\Http\SingleActions\MainAction;
use App\Models\Platform\GamePlatform;
use Illuminate\Http\Request;

/**
 * Class MainAction
 * @package App\Http\SingleActions\Backend\Merchant\Game
 */
class BaseAction extends MainAction
{

    /**
     * @var GamePlatform
     */
    protected $model;

     /**
      * MainAction constructor.
      * @param GamePlatform $gamesPlatform GamesPlatforms.
      * @param Request      $request       Request.
      * @throws \Exception Exception.
      */
    public function __construct(GamePlatform $gamesPlatform, Request $request)
    {
        parent::__construct($request);
        $this->model = $gamesPlatform;
    }
}
