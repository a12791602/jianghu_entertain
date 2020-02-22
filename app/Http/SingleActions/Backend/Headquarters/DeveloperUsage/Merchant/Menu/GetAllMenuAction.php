<?php

namespace App\Http\SingleActions\Backend\Headquarters\DeveloperUsage\Merchant\Menu;

use App\Http\SingleActions\MainAction;
use App\Models\DeveloperUsage\Menu\MerchantSystemMenu;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class for menu change parent action.
 */
class GetAllMenuAction extends MainAction
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
     * @return JsonResponse
     */
    public function execute(): JsonResponse
    {
        $data   = $this->model->forStar();
        $msgOut = msgOut($data);
        return $msgOut;
    }
}
