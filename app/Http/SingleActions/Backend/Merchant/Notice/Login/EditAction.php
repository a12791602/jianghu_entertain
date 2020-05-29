<?php

namespace App\Http\SingleActions\Backend\Merchant\Notice\Login;

use App\Events\AnnouncementEvent;
use App\Lib\Constant\JHHYCnst;
use Arr;
use Illuminate\Http\JsonResponse;

/**
 * Class EditAction
 * @package App\Http\SingleActions\Backend\Merchant\Notice\Login
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
            throw new \Exception('201804');
        }
        $model->fill($inputData);
        $result = $model->save();
        if ($result) {
            $broadcast_data = Arr::only($inputData, ['title', 'pic', 'link', 'device']);
            broadcast(new AnnouncementEvent(JHHYCnst::ANNOUNCEMENT_SIGN_IN, $broadcast_data));
            return msgOut();
        }
        throw new \Exception('201801');
    }
}
