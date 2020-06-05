<?php

namespace App\Http\SingleActions\Backend\Merchant\Notice\Marquee;

use App\Events\FrontendAnnouncementEvent;
use App\Lib\Constant\JHHYCnst;
use Arr;
use Illuminate\Http\JsonResponse;

/**
 * Class AddDoAction
 * @package App\Http\SingleActions\Backend\Merchant\Notice\Marquee
 */
class AddDoAction extends BaseAction
{
    /**
     * ***
     * @param array $inputData InputData.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputData): JsonResponse
    {
        $inputData['platform_id'] = $this->currentPlatformEloq->id;
        $inputData['author_id']   = $this->user->id;
        $this->model->fill($inputData);
        $result = $this->model->save();
        if ($result) {
            $broadcast_data = Arr::only($inputData, ['title', 'content', 'device']);
            broadcast(new FrontendAnnouncementEvent(JHHYCnst::ANNOUNCEMENT_SCROLL, $broadcast_data));
            return msgOut();
        }
        throw new \Exception('201600');
    }
}
