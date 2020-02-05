<?php

namespace App\Http\SingleActions\Backend\Merchant\Game;

use App\Http\SingleActions\MainAction;
use App\Models\Platform\GamesPlatform;
use Illuminate\Http\Request;

/**
 * Class MainAction
 * @package App\Http\SingleActions\Backend\Merchant\Game
 */
class BaseAction extends MainAction
{

    /**
     * @var GamesPlatform
     */
    protected $model;

     /**
      * MainAction constructor.
      * @param GamesPlatform $gamesPlatform GamesPlatforms.
      * @param Request       $request       Request.
      * @throws \Exception Exception.
      */
    public function __construct(GamesPlatform $gamesPlatform, Request $request)
    {
        parent::__construct($request);
        $this->model = $gamesPlatform;
    }
}
