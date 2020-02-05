<?php

namespace App\Http\SingleActions\Backend\Merchant\Notice\Carousel;

use App\Http\SingleActions\MainAction;
use App\Models\Notice\NoticeCarousel;
use Illuminate\Http\Request;

/**
 * Class MainAction
 * @package App\Http\SingleActions\Backend\Merchant\Notice\Carousel
 */
class BaseAction extends MainAction
{

    /**
     * @var NoticeCarousel $model
     */
    public $model;

     /**
      * MainAction constructor.
      * @param NoticeCarousel $noticeCarousel NoticeCarousel.
      * @param Request        $request        Request.
      * @throws \Exception Exception.
      */
    public function __construct(NoticeCarousel $noticeCarousel, Request $request)
    {
        parent::__construct($request);
        $this->model = $noticeCarousel;
    }
}
