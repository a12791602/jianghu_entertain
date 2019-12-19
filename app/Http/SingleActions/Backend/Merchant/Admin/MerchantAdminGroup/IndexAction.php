<?php

namespace App\Http\SingleActions\Backend\Merchant\Admin\MerchantAdminGroup;

use App\ModelFilters\Admin\MerchantAdminAccessGroupFilter;
use App\Models\Admin\MerchantAdminAccessGroup;
use Illuminate\Http\JsonResponse;

/**
 * Class for index action.
 */
class IndexAction
{

    /**
     * @var object MerchantAdminAccessGroup
     */
    protected $model;

    /**
     * @param MerchantAdminAccessGroup $merchantAdminAccessGroup MerchantAdminAccessGroup.
     */
    public function __construct(MerchantAdminAccessGroup $merchantAdminAccessGroup)
    {
        $this->model = $merchantAdminAccessGroup;
    }

    /**
     * @param  string $platformSign 平台标识.
     * @return JsonResponse
     */
    public function execute(string $platformSign): JsonResponse
    {
        $filterArr = ['platform' => $platformSign];
        $data      = $this->model
                          ->filter($filterArr, MerchantAdminAccessGroupFilter::class)
                          ->get()
                          ->toArray();

        $msgOut = msgOut(true, $data);
        return $msgOut;
    }
}
