<?php

namespace App\Http\SingleActions\Backend\Headquarters\DeveloperUsage\Merchant\Menu;

use App\Models\DeveloperUsage\Menu\MerchantSystemMenu;
use Illuminate\Http\JsonResponse;

/**
 * Class for menu edit action.
 */
class EditAction
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
        $menuEloq = $this->model::find($inputDatas['id']);
        if (!$menuEloq) {
            throw new \Exception('202801');
        }
        $menuEloq->fill($inputDatas);
        if (!$menuEloq->save()) {
            throw new \Exception('202804');
        }
        $msgOut = msgOut(['label' => $menuEloq->label]);
        return $msgOut;
    }
}
