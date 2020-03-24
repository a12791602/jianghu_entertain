<?php

namespace App\Http\SingleActions\Backend\Headquarters\DeveloperUsage\SystemBank;

use App\Models\Finance\SystemPlatformBank;
use Illuminate\Http\JsonResponse;

/**
 * Class DelDoAction
 *
 * @package App\Http\SingleActions\Backend\Headquarters\DeveloperUsage\SystemBank
 */
class DelDoAction extends BaseAction
{
    /**
     * @param array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        if (!SystemPlatformBank::where('bank_id', $inputDatas['id'])->get()->isEmpty()) {
            throw new \Exception('300903');
        }
        if ($this->model->where('id', $inputDatas['id'])->delete()) {
            $msgOut = msgOut();
            return $msgOut;
        }
        throw new \Exception('300902');
    }
}
