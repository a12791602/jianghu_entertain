<?php

namespace App\Http\SingleActions\Backend\Merchant\Notice\System;

use App\Lib\Constant\JHHYCnst;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;

/**
 * Class AddDoAction
 * @package App\Http\SingleActions\Backend\Merchant\Notice\System
 */
class AddDoAction extends BaseAction
{
    /**
     * ***
     * @param array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $inputDatas['author_id']   = $this->user->id;
        $inputDatas['platform_id'] = $this->currentPlatformEloq->id;
        $inputDatas['device']      = $this->getDevice($inputDatas);
        $this->model->fill($inputDatas);
        $result = $this->model->save();
        if ($result) {
            return msgOut();
        }
        throw new \Exception('201700');
    }

    /**
     * 获取设备数据保存之前 以后要 调整这些接口设计不统一的 暂时把泰博的接口 能调通
     * @param array $data Input.
     * @return array<int,int>
     */
    protected function getDevice(array $data): array
    {
        $device   = [];
        $criteria = [
                     'h5_pic_id'  => JHHYCnst::DEVICE_H5,
                     'app_pic_id' => JHHYCnst::DEVICE_APP,
                     'pc_pic_id'  => JHHYCnst::DEVICE_PC,
                    ];
        foreach ($criteria as $criKey => $criVal) {
            $exist = Arr::exists($data, $criKey);
            if (!$exist) {
                continue;
            }
            $device[] = $criVal;
        }
        return $device;
    }
}
