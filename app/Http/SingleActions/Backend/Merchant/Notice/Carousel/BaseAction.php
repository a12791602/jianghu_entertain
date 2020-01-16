<?php

namespace App\Http\SingleActions\Backend\Merchant\Notice\Carousel;

use App\Models\Notice\NoticeCarousel;

/**
 * Class BaseAction
 * @package App\Http\SingleActions\Backend\Merchant\Notice\Carousel
 */
class BaseAction
{

    /**
     * @var NoticeCarousel $model
     */
    public $model;

    /**
     * BaseAction constructor.
     * @param NoticeCarousel $noticeCarousel NoticeCarousel.
     */
    public function __construct(NoticeCarousel $noticeCarousel)
    {
        $this->model = $noticeCarousel;
    }
}
