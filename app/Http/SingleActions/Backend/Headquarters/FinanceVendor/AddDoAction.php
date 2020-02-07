<?php

namespace App\Http\SingleActions\Backend\Headquarters\FinanceVendor;

use Illuminate\Http\JsonResponse;

/**
 * Class AddDoAction
 *
 * @package App\Http\SingleActions\Backend\Headquarters\FinanceVendor
 */
class AddDoAction extends BaseAction
{
    
    /**
     * @param  array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $inputDatas['author_id'] = $this->user->id;
        $this->model->fill($inputDatas);
        if ($this->model->save()) {
            return msgOut();
        }
        throw new \Exception('300600');
    }
}
