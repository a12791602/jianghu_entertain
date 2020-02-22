<?php

namespace App\Http\SingleActions\Backend\Headquarters\DeveloperUsage\Merchant\Menu;

use App\Http\SingleActions\MainAction;
use App\Models\DeveloperUsage\Menu\MerchantSystemMenu;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class for menu do add action.
 */
class DoAddAction extends MainAction
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
     * @throws \Exception Exception.
     * @return JsonResponse
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $currentMaxSort     = $this->model->where(['pid' => $inputDatas['pid']])->max('sort');
        $inputDatas['sort'] = $currentMaxSort + 1;
        $menuEloq           = new MerchantSystemMenu();
        $menuEloq->fill($inputDatas);
        if (!$menuEloq->save()) {
            throw new \Exception('202800');
        }
        $this->model->deleteCache();
        $msgOut = msgOut(['label' => $menuEloq->label]);
        return $msgOut;
    }
}
