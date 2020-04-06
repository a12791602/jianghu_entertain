<?php

namespace App\Http\SingleActions\Backend\Merchant\Setting\PromotionPic;

use App\Http\SingleActions\MainAction;
use App\Models\Systems\SystemPromotionPic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * 推广图片-添加
 */
class DoAddAction extends MainAction
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
        $inputDatas['platform_id']    = $this->currentPlatformEloq->id;
        $inputDatas['author_id']      = $this->user->id;
        $inputDatas['last_editor_id'] = $this->user->id;
        $this->model->fill($inputDatas);
        if (!$this->model->save()) {
            throw new \Exception('203100');
        }
        return msgOut();
    }
}
