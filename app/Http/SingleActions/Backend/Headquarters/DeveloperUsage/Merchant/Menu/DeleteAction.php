<?php

namespace App\Http\SingleActions\Backend\Headquarters\DeveloperUsage\Merchant\Menu;

use App\Models\DeveloperUsage\Menu\MerchantSystemMenu;
use Illuminate\Http\JsonResponse;

/**
 * Class for menu delete action.
 */
class DeleteAction
{

    /**
     * @var MerchantSystemMenu
     */
    protected $model;

    /**
     * @param MerchantSystemMenu $merchantSystemMenu Model.
     */
    public function __construct(MerchantSystemMenu $merchantSystemMenu)
    {
        $this->model = $merchantSystemMenu;
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
            $msgOut = msgOut($datas);
            return $msgOut;
        } catch (\Throwable $e) {
            throw new \Exception('300002');
        }
    }
}
