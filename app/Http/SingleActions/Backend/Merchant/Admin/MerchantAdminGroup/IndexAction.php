<?php

namespace App\Http\SingleActions\Backend\Merchant\Admin\MerchantAdminGroup;

use App\Http\SingleActions\MainAction;
use App\ModelFilters\Admin\MerchantAdminAccessGroupFilter;
use App\Models\Admin\MerchantAdminAccessGroup;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class for index action.
 */
class IndexAction extends MainAction
{

    /**
     * @var object MerchantAdminAccessGroup
     */
    protected $model;

    /**
     * @param MerchantAdminAccessGroup $merchantAdminAccessGroup MerchantAdminAccessGroup.
     * @param Request                  $request                  Request.
     * @throws \Exception Exception.
     */
    public function __construct(
        MerchantAdminAccessGroup $merchantAdminAccessGroup,
        Request $request
    ) {
        parent::__construct($request);
        $this->model = $merchantAdminAccessGroup;
    }

    /**
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(): JsonResponse
    {
        $filterArr = ['platform' => $this->currentPlatformEloq->sign];
        $data      = $this->model
            ->filter($filterArr, MerchantAdminAccessGroupFilter::class)
            ->select('id', 'group_name', 'created_at')
            ->with('detail:group_id,menu_id')
            ->get();

        $msgOut = msgOut($data);
        return $msgOut;
    }
}
