<?php

namespace App\Http\SingleActions\Backend\Merchant\Notice\System;

use Illuminate\Http\JsonResponse;

/**
 * Class IndexAction
 * @package App\Http\SingleActions\Backend\Merchant\Notice\System
 */
class IndexAction extends BaseAction
{

    /**
     * @var object $model
     */
    public $model;

    /**
     * ***
     * @param array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {

        $inputDatas['platform_id'] = $this->currentPlatformEloq->id;
        $data                      = $this->model
            ->with(
                [
                 'author:id,name',
                 'lastEditor:id,name',
                ],
            )->filter($inputDatas)
            ->paginate($this->perPage);
        $data->each(
            static function ($item): void {
                $item->append(['h5_pic']);
                $item->append(['app_pic']);
                $item->append(['pc_pic']);
            },
        );
        return msgOut($data);
    }
}
