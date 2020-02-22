<?php

namespace App\Http\SingleActions\Backend\Headquarters\DeveloperUsage\Merchant\Menu;

use App\Http\SingleActions\MainAction;
use App\Models\DeveloperUsage\Menu\MerchantSystemMenu;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class for menu change parent action.
 */
class ChangeParentAction extends MainAction
{

    /**
     * @var MerchantSystemMenu
     */
    protected $model;

    /**
     * @param Request            $request            Request.
     * @param MerchantSystemMenu $merchantSystemMenu Model.
     */
    public function __construct(
        Request $request,
        MerchantSystemMenu $merchantSystemMenu
    ) {
        parent::__construct($request);
        $this->model = $merchantSystemMenu;
    }

    /**
     * @param  array $inputDatas 传递的参数.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $menuLabel = $this->model::changeParent($inputDatas);
        $this->model->deleteCache();
        $msgOut = msgOut(['label' => $menuLabel]);
        return $msgOut;
    }
}
