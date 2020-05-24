<?php

namespace App\Http\SingleActions\Backend\Merchant\Finance\Online;

use App\Models\Finance\SystemFinanceType;
use App\Models\Finance\SystemFinanceUserTag;
use DB;
use Illuminate\Http\JsonResponse;
use Log;

/**
 * Class AddDoAction
 * @package App\Http\SingleActions\Backend\Merchant\Finance\Online
 */
class AddDoAction extends BaseAction
{
    /**
     * @param array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \RuntimeException Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        try {
            $platformSign                = $this->currentPlatformEloq->sign;
            $platformId                  = $this->currentPlatformEloq->id;
            $inputDatas['platform_sign'] = $platformSign;
            $inputDatas['author_id']     = $this->user->id;
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
                    $tmpData['platform_id']       = $platformId;
                    $tmpData['is_online']         = SystemFinanceType::IS_ONLINE_YES;
                    $tmpData['online_finance_id'] = $this->model->id;
                    $tmpData['tag_id']            = $tagId;
                    $data[]                       = $tmpData;
                }
                if (!empty($data)) {
                    SystemFinanceUserTag::insert($data);
                }
            }
            DB::commit();
            return msgOut();
        } catch (\RuntimeException $exception) {
            Log::error($exception->getMessage());
        }//end try
        DB::rollBack();
        throw new \RuntimeException('201400');
    }
}
