<?php

namespace App\Http\SingleActions\Backend\Merchant\Finance\Offline;

use App\Models\Finance\SystemFinanceType;
use App\Models\Finance\SystemFinanceUserTag;
use Arr;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

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
        $flag = false;
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
            $this->model->fill($dataToSave);
            if ($this->model->save()) {
                $userTags                       = [];
                $userTags['platform_id']        = $platformId;
                $userTags['is_online']          = SystemFinanceType::IS_ONLINE_NO;
                $userTags['offline_finance_id'] = $this->model->id;
                $userTags['tag_id']             = $inputDatas['tags'];

                SystemFinanceUserTag::create($userTags);
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
        throw new \Exception('200600');
    }
}
