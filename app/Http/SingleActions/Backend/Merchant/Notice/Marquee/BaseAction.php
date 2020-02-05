<?php

namespace App\Http\SingleActions\Backend\Merchant\Notice\Marquee;

use App\Http\SingleActions\MainAction;
use App\Models\Notice\NoticeMarquee;
use Illuminate\Http\Request;

/**
 * Class MainAction
 * @package App\Http\SingleActions\Backend\Merchant\Notice\Marquee
 */
class BaseAction extends MainAction
{

    /**
     * 跑马灯公告模型.
     *
     * @var NoticeMarquee $model
     */
    protected $model;

     /**
      * MainAction constructor.
      * @param NoticeMarquee $noticeMarquee NoticeMarquee.
      * @param Request       $request       Request.
      * @throws \Exception Exception.
      */
    public function __construct(NoticeMarquee $noticeMarquee, Request $request)
    {
        parent::__construct($request);
        $this->model = $noticeMarquee;
    }
}
