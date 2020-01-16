<?php

namespace App\Http\SingleActions\Backend\Headquarters\SystemBank;

use App\Http\Controllers\BackendApi\BackEndApiMainController;
use App\Models\Finance\SystemPlatformBank;
use App\Models\Systems\SystemPlatform;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

/**
 * Class AddDoAction
 *
 * @package App\Http\SingleActions\Backend\Headquarters\SystemBank
 */
class AddDoAction extends BaseAction
{
    /**
     * @param  BackEndApiMainController $contll     Contll.
     * @param  array                    $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(BackEndApiMainController $contll, array $inputDatas): JsonResponse
    {
        $flag = false;
        try {
            $inputDatas['author_id'] = $contll->currentAdmin->id;
            DB::beginTransaction();
            $this->model->fill($inputDatas);
            if ($this->model->save()) {
                $lastId    = $this->model->id;
                $platforms = SystemPlatform::select('sign as platform_sign')->get()->toArray();
                $data      = [];
                foreach ($platforms as $platform) {
                    $platform['bank_id'] = $lastId;
                    $data[]              = $platform;
                }
                SystemPlatformBank::insert($data);
                $flag = true;
            }
        } catch (\Throwable $exception) {
            $flag = false;
        }
        if (!$flag) {
            DB::rollBack();
            throw new \Exception('300900');
        }
        DB::commit();
        $msgOut = msgOut();
        return $msgOut;
    }
}
