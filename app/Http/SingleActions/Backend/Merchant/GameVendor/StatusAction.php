<?php
namespace App\Http\SingleActions\Backend\Merchant\GameVendor;

use Illuminate\Http\JsonResponse;

class StatusAction extends BaseAction
{
    /**
     * @param array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas) :JsonResponse
    {
        $field = 'status';
        if ((int)$inputDatas['type'] === 1) { //如果type == 1 则 修改的是 是否维护字段
            $field = 'is_maintain';
        }
        if ($this->model->where('id', $inputDatas['id'])->update([$field => $inputDatas['status']])) {
            return msgOut(true);
        } else {
            throw new \Exception('300304');
        }
    }
}