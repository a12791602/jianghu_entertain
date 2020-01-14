<?php

namespace App\Http\SingleActions\Backend\Merchant\Notice\System;

use App\Models\Notice\NoticeSystem;

/**
 * Class BaseAction
 * @package App\Http\SingleActions\Backend\Merchant\Notice\System
 */
class BaseAction
{

    /**
     * @var NoticeSystem $model
     */
    public $model;

    /**
     * BaseAction constructor.
     * @param NoticeSystem $noticeSystem NoticeSystem.
     */
    public function __construct(NoticeSystem $noticeSystem)
    {
        $this->model = $noticeSystem;
    }
}
