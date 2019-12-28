<?php

namespace App\Http\SingleActions\Backend\Merchant\Finance\Online;

use App\Http\Controllers\BackendApi\BackEndApiMainController;
use App\Models\Finance\SystemFinanceType;
use App\Models\Finance\SystemFinanceUserTag;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

/**
 * Class AddDoAction
 * @package App\Http\SingleActions\Backend\Merchant\Finance\Online
 */
class AddDoAction extends BaseAction
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
            $platformSign                = $contll->currentPlatformEloq->sign;
            $platformId                  = $contll->currentPlatformEloq->id;
            $inputDatas['platform_sign'] = $platformSign;
            $inputDatas['author_id']     = $contll->currentAdmin->id;
            $tags                        = [];
            if (isset($inputDatas['tags'])) {
                $tags = $inputDatas['tags'];
                unset($inputDatas['tags']);
            }
            DB::beginTransaction();
            $this->model->fill($inputDatas);
            if ($this->model->save()) {
                $tmpData = [];
                $data    = [];
                foreach ($tags as $tagId) {
                    $tmpData['platform_id'] = $platformId;
                    $tmpData['is_online']   = SystemFinanceType::IS_ONLINE_YES;
                    $tmpData['finance_id']  = $this->model->id;
                    $tmpData['tag_id']      = $tagId;
                    $data[]                 = $tmpData;
                }
                if (!empty($data)) {
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
        throw new \Exception('201400');
    }
}