<?php

namespace App\Http\SingleActions\Backend\Merchant\Notice\System;

use App\Http\SingleActions\MainAction;
use App\Models\Notice\NoticeSystem;
use Illuminate\Http\Request;

/**
 * Class MainAction
 * @package App\Http\SingleActions\Backend\Merchant\Notice\System
 */
class BaseAction extends MainAction
{

    /**
     * @var NoticeSystem $model
     */
    public $model;

     /**
      * MainAction constructor.
      * @param NoticeSystem $noticeSystem NoticeSystem.
      * @param Request      $request      Request.
      * @throws \Exception Exception.
      */
    public function __construct(NoticeSystem $noticeSystem, Request $request)
    {
        parent::__construct($request);
        $this->model = $noticeSystem;
    }
}
