<?php

namespace App\Http\SingleActions\Backend\Merchant\Finance\Online;

use App\Http\Controllers\BackendApi\BackEndApiMainController;
use App\Models\Finance\SystemFinanceType;
use App\Models\Finance\SystemFinanceUserTag;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

/**
 * Class EditAction
 * @package App\Http\SingleActions\Backend\Merchant\Finance\Online
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
        $method = strtolower($inputDatas['method']);
        if ($method === 'get') {
            $userTags = SystemFinanceUserTag::where('is_online', SystemFinanceType::IS_ONLINE_YES)
                ->where('finance_id', $inputDatas['id'])->select('tag_id')->get();
            $result   = msgOut(true, $userTags);
            return $result;
        }
        $flag = false;
        try {
            $inputDatas['platform_sign'] = $contll->currentPlatformEloq->sign;
            $inputDatas['author_id']     = $contll->currentAdmin->id;
            $tags                        = [];
            if (isset($inputDatas['tags'])) {
                $tags = $inputDatas['tags'];
                unset($inputDatas['tags']);
            }
            unset($inputDatas['method']);
            $model = $this->model->find($inputDatas['id']);
            DB::beginTransaction();
            $model->fill($inputDatas);
            if ($model->save()) {
                $tmpData = [];
                $data    = [];
                foreach ($tags as $tagId) {
                    $tmpData['platform_id'] = $contll->currentPlatformEloq->id;
                    $tmpData['is_online']   = SystemFinanceType::IS_ONLINE_YES;
                    $tmpData['finance_id']  = $inputDatas['id'];
                    $tmpData['tag_id']      = $tagId;
                    $data[]                 = $tmpData;
                }
                if (!empty($data)) {
                    SystemFinanceUserTag::where('platform_id', $contll->currentPlatformEloq->id)
                        ->where('finance_id', $inputDatas['id'])->where('is_online', SystemFinanceType::IS_ONLINE_YES)
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
        throw new \Exception('201401');
    }
}
