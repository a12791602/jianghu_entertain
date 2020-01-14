<?php

namespace App\Http\SingleActions\Backend\Merchant\Notice\Marquee;

use App\Models\Notice\NoticeMarquee;

/**
 * Class BaseAction
 * @package App\Http\SingleActions\Backend\Merchant\Notice\Marquee
 */
class BaseAction
{

    /**
     * 跑马灯公告模型.
     *
     * @var NoticeMarquee $model
     */
    protected $model;

    /**
     * BaseAction constructor.
     * @param NoticeMarquee $noticeMarquee NoticeMarquee.
     */
    public function __construct(NoticeMarquee $noticeMarquee)
    {
        $this->model = $noticeMarquee;
    }
}
