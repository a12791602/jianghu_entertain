<?php

namespace App\Http\SingleActions\Backend\Headquarters\DeveloperUsage\Merchant\Menu;

use App\Models\DeveloperUsage\Menu\MerchantSystemMenu;
use Illuminate\Http\JsonResponse;

/**
 * Class for menu change parent action.
 */
class ChangeParentAction
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
        $parseDatas  = json_decode($inputDatas['drag_result'], true);
        $itemProcess = [];
        if (!empty($parseDatas)) {
            $itemProcess = $this->model->changeParent($parseDatas);
            $msgOut      = msgOut(true, $itemProcess);
            return $msgOut;
        }
        throw new \Exception('300001');
    }
}
