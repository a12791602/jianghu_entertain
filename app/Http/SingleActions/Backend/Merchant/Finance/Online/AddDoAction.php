<?php

namespace App\Http\SingleActions\Backend\Merchant\Finance\Online;

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
     * @param array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $flag = false;
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
                $flag = true;
            }
        } catch (\Throwable $exception) {
            $flag = false;
        }
        if ($flag) {
            DB::commit();
            $result = msgOut();
            return $result;
        }
        DB::rollBack();
        throw new \Exception('201400');
    }
}
