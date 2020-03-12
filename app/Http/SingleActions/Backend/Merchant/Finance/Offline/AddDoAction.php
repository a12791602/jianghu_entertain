<?php

namespace App\Http\SingleActions\Backend\Merchant\Finance\Offline;

use App\Models\Finance\SystemFinanceType;
use App\Models\Finance\SystemFinanceUserTag;
use Arr;
use DB;
use Illuminate\Http\JsonResponse;
use Log;

/**
 * Class AddDoAction
 * @package App\Http\SingleActions\Backend\Merchant\Finance\Offline
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
        try {
            $platformId = $this->currentPlatformEloq->id;
            $dataToSave = Arr::only(
                $inputDatas,
                [
                 'type_id',
                 'name',
                 'username',
                 'account',
                 'qrcode',
                 'branch',
                 'min',
                 'max',
                 'fee',
                 'remark',
                 'bank_id',
                ],
            );

            DB::beginTransaction();
            $dataToSave['author_id'] = $this->user->id;
            $this->model->fill($dataToSave);
            if ($this->model->save()) {
                $userTags                       = [];
                $userTags['platform_id']        = $platformId;
                $userTags['is_online']          = SystemFinanceType::IS_ONLINE_NO;
                $userTags['offline_finance_id'] = $this->model->id;
                $userTags['tag_id']             = $inputDatas['tags'];

                SystemFinanceUserTag::create($userTags);
                DB::commit();
                $result = msgOut();
                return $result;
            }
        } catch (\Throwable $exception) {
            Log::error($exception->getMessage());
        }

        DB::rollBack();
        throw new \Exception('200600');
    }
}
