<?php

namespace App\Http\SingleActions\Backend\Headquarters\DeveloperUsage\Backend\Menu;

use App\Models\DeveloperUsage\Menu\BackendSystemMenu;
use Illuminate\Http\JsonResponse;

/**
 * Class for menu delete action.
 */
class DeleteAction
{

    /**
     * @var BackendSystemMenu
     */
    protected $model;

    /**
     * @param BackendSystemMenu $backendSystemMenu Model.
     */
    public function __construct(BackendSystemMenu $backendSystemMenu)
    {
        $this->model = $backendSystemMenu;
    }

    /**
     * @param  array $inputDatas 传递的参数.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $toDelete = $inputDatas['toDelete'];
        try {
            $data  = [];
            $datas = $this->model->find($toDelete)->each(
                static function ($product) use ($data) {
                    $data[] = $product->toArray();
                    $product->delete();
                    return $data;
                },
            );
            $this->model->refreshStar();
            $msgOut = msgOut(true, $datas);
            return $msgOut;
        } catch (\Throwable $e) {
            throw new \Exception('300002');
        }
    }
}
