<?php

namespace App\Http\SingleActions\Backend\Merchant\Finance\Online;

use App\Models\Finance\SystemFinanceType;
use App\Models\Finance\SystemFinanceUserTag;
use Arr;
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
     * @param array $inputData InputData.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputData): JsonResponse
    {
        $platformSign               = $this->currentPlatformEloq->sign;
        $platformId                 = $this->currentPlatformEloq->id;
        $inputData['platform_sign'] = $platformSign;
        $inputData['author_id']     = $this->user->id;
        $tags                       = $inputData['tags'];
        Arr::forget($inputData, 'tags');
        DB::beginTransaction();
        $this->model->fill($inputData);
        try {
            if ($this->model->save()) {
                $userTags = [
                             'platform_id'       => $platformId,
                             'is_online'         => SystemFinanceType::IS_ONLINE_YES,
                             'online_finance_id' => $this->model->id,
                             'tag_id'            => $tags ?? [],
                            ];
                SystemFinanceUserTag::create($userTags);
                DB::commit();
                return msgOut();
            }
        } catch (\RuntimeException $exception) {
            Log::error($exception->getMessage());
        }//end try
        DB::rollBack();
        throw new \Exception('201400');
    }
}
