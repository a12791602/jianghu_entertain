<?php

namespace App\Http\SingleActions\Backend\Headquarters\DeveloperUsage\Merchant\Menu;

use App\Models\DeveloperUsage\Menu\MerchantSystemMenu;
use Illuminate\Http\JsonResponse;

/**
 * Class for menu change parent action.
 */
class GetAllMenuAction
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
     * @return JsonResponse
     */
    public function execute(): JsonResponse
    {
        $data   = $this->model->forStar();
        $msgOut = msgOut(true, $data);
        return $msgOut;
    }
}
