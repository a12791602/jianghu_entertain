<?php

namespace App\Http\SingleActions\Backend\Merchant\Notice\Login;

use App\Models\Notice\NoticeLogin;

/**
 * Class BaseAction
 * @package App\Http\SingleActions\Backend\Merchant\Notice\Login
 */
class BaseAction
{

    /**
     * @var NoticeLogin $model
     */
    public $model;

    /**
     * BaseAction constructor.
     * @param NoticeLogin $noticeLogin NoticeLogin.
     */
    public function __construct(NoticeLogin $noticeLogin)
    {
        $this->model = $noticeLogin;
    }
}
