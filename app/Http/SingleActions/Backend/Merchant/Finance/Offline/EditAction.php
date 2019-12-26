<?php

namespace App\Http\SingleActions\Backend\Merchant\Finance\Offline;

use App\Http\Controllers\BackendApi\BackEndApiMainController;
use App\Models\Finance\SystemFinanceType;
use App\Models\Finance\SystemFinanceUserTag;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

/**
 * Class EditAction
 * @package App\Http\SingleActions\Backend\Merchant\Finance\Offline
 */
class EditAction extends BaseAction
{
    /**
     * @param BackEndApiMainController $contll     Contll.
     * @param array                    $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(BackEndApiMainController $contll, array $inputDatas): JsonResponse
    {
        $flag = false;
        try {
            $platformId                = $contll->currentPlatformEloq->id;
            $inputDatas['platform_id'] = $platformId;
            $inputDatas['author_id']   = $contll->currentAdmin->id;
            $tags                      = [];
            if (isset($inputDatas['tags'])) {
                $tags = $inputDatas['tags'];
                unset($inputDatas['tags']);
            }
            DB::beginTransaction();
            $model = $this->model->find($inputDatas['id']);
            $model->fill($inputDatas);
            if ($model->save()) {
                $tmpData = [];
                $data    = [];
                foreach ($tags as $tagId) {
                    $tmpData['platform_id'] = $platformId;
                    $tmpData['is_online']   = SystemFinanceType::IS_ONLINE_NO;
                    $tmpData['finance_id']  = $inputDatas['id'];
                    $tmpData['tag_id']      = $tagId;
                    $data[]                 = $tmpData;
                }
                if (!empty($data)) {
                    SystemFinanceUserTag::where('platform_id', $platformId)
                        ->where('finance_id', $inputDatas['id'])
                        ->delete();
                    SystemFinanceUserTag::insert($data);
                }
                $flag = true;
            }
        } catch (\Throwable $exception) {
            $flag = false;
        }
        if ($flag) {
            DB::commit();
            $result = msgOut(true);
            return $result;
        }
        DB::rollBack();
        throw new \Exception('200600');
    }
}
