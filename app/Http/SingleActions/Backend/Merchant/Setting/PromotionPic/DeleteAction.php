<?php

namespace App\Http\SingleActions\Backend\Merchant\Setting\PromotionPic;

use App\Http\SingleActions\MainAction;
use App\Models\Systems\SystemPromotionPic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * 推广图片-删除
 */
class DeleteAction extends MainAction
{

    /**
     * @var object
     */
    protected $model;

    /**
     * @param SystemPromotionPic $systemPromotionPic Model.
     * @param Request            $request            Request.
     * @throws \Exception Exception.
     */
    public function __construct(SystemPromotionPic $systemPromotionPic, Request $request)
    {
        parent::__construct($request);
        $this->model = $systemPromotionPic;
    }

    /**
     * @param array $inputDatas 接收的参数.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $filterArr    = [
                         'data_id'     => $inputDatas['id'],
                         'platform_id' => $this->currentPlatformEloq->id,
                        ];
        $promotionPic = $this->model
            ->filter($filterArr)
            ->first();
        if (!$promotionPic) {
            throw new \Exception('203101');
        }

        if (!$promotionPic->delete()) {
            throw new \Exception('203103');
        }
        return msgOut();
    }
}
