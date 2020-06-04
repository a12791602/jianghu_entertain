<?php

namespace App\Http\SingleActions\Backend\Merchant\Notice\Marquee;

use App\Events\FrontendAnnouncementEvent;
use App\Lib\Constant\JHHYCnst;
use Arr;
use Illuminate\Http\JsonResponse;

/**
 * Class EditAction
 * @package App\Http\SingleActions\Backend\Merchant\Notice\Marquee
 */
class EditAction extends BaseAction
{
    /**
     * ***
     * @param array $inputData InputData.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputData): JsonResponse
    {
        $inputData['last_editor_id'] = $this->user->id;
        $model                       = $this->model->find($inputData['id']);
        if (!$model instanceof $this->model) {
            throw new \Exception('201604');
        }
        $result = $model->update($inputData);
        if ($result) {
            $broadcast_data = Arr::only($inputData, ['title', 'content', 'device']);
            broadcast(new FrontendAnnouncementEvent(JHHYCnst::ANNOUNCEMENT_SCROLL, $broadcast_data));
            return msgOut();
        }
        throw new \Exception('201601');
    }
}
