<?php

namespace App\Http\SingleActions\Backend\Merchant\Notice\Login;

use App\Http\SingleActions\MainAction;
use App\Models\Notice\NoticeLogin;
use Illuminate\Http\Request;

/**
 * Class MainAction
 * @package App\Http\SingleActions\Backend\Merchant\Notice\Login
 */
class BaseAction extends MainAction
{

    /**
     * @var NoticeLogin $model
     */
    public $model;

     /**
      * MainAction constructor.
      * @param NoticeLogin $noticeLogin NoticeLogin.
      * @param Request     $request     Request.
      * @throws \Exception Exception.
      */
    public function __construct(NoticeLogin $noticeLogin, Request $request)
    {
        parent::__construct($request);
        $this->model = $noticeLogin;
    }
}
