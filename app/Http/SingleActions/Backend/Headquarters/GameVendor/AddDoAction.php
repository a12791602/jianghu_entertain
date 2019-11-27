<?php

namespace App\Http\SingleActions\Backend\Headquarters\GameVendor;

use App\Http\Controllers\BackendApi\Headquarters\BackEndApiMainController;
use Illuminate\Http\JsonResponse;

/**
 * Class AddDoAction
 * @package App\Http\SingleActions\Backend\Headquarters\GameVendor
 */
class AddDoAction extends BaseAction
{
    /**
     * @param BackEndApiMainController $contll     Contll.
     * @param array                    $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(BackEndApiMainController $contll, array $inputDatas) :JsonResponse
    {
        $inputDatas['author_id'] = $contll->currentAdmin->id;
        $this->model->fill($inputDatas);
        if ($this->model->save()) {
            return msgOut(true, [], '200', '添加成功');
        } else {
            throw new \Exception('300302');
        }
    }
}
