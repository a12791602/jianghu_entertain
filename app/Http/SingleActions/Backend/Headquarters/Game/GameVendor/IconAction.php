<?php

namespace App\Http\SingleActions\Backend\Headquarters\Game\GameVendor;

use App\Models\Game\Game;
use App\Models\Game\GamePlatform;
use App\Models\Game\GameVendor;
use App\Models\Systems\StaticResource;
use Illuminate\Http\JsonResponse;

/**
 * Class IconAction
 * @package App\Http\SingleActions\Backend\Headquarters\Game\GameVendor
 */
class IconAction extends BaseAction
{

    /**
     * @param  array $inputData InputData.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputData): JsonResponse
    {
        $model = $this->model->find($inputData['id']);
        if (!$model instanceof GameVendor) {
            throw new \Exception('300201');
        }
        $resource = [
                     'type'        => 1,
                     'title'       => 'game_vendors_icon',
                     'table_name'  => 'game_vendors',
                     'description' => '厂商游戏 icon',
                    ];
        $model->icon_id = $inputData['icon_id'];
        try {
            $model->update();
            StaticResource::where(['id' => $inputData['icon_id']])->update($resource);
            return msgOut();
        } catch (\RuntimeException $exception) {
            \Log::error($exception->getMessage());
        }
        throw new \Exception('300201');
    }
}
