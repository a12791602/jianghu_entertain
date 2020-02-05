<?php

namespace App\Http\SingleActions\Backend\Merchant\Notice\Marquee;

use Illuminate\Http\JsonResponse;

/**
 * Class StatusAction
 * @package App\Http\SingleActions\Backend\Merchant\Notice\Marquee
 */
class StatusAction extends BaseAction
{
    /**
     * ***
     * @param array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $result = $this->model->where('id', $inputDatas['id'])->update(
            [
             'last_editor_id' => $this->user->id,
             'status'         => $inputDatas['status'],
            ],
        );
        if ($result) {
            $msgOut = msgOut();
            return $msgOut;
        }
        throw new \Exception('201603');
    }
}
