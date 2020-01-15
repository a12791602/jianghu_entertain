<?php

namespace App\Http\SingleActions\Backend\Headquarters\Admin\BackendAdminUser;

use App\ModelFilters\Admin\BackendAdminUserFilter;
use App\Models\Admin\MerchantAdminUser;
use Illuminate\Http\JsonResponse;

/**
 * Class for search admin action.
 */
class SearchAdminAction
{

    /**
     * @var object $model MerchantAdminUser.
     */
    protected $model;

    /**
     * @param MerchantAdminUser $merchantAdminUser MerchantAdminUser.
     */
    public function __construct(MerchantAdminUser $merchantAdminUser)
    {
        $this->model = $merchantAdminUser;
    }

    /**
     * @param array $inputDatas 接收的参数.
     * @return JsonResponse
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $data   = $this->model->filter($inputDatas, BackendAdminUserFilter::class)->get()->toArray();
        $msgOut = msgOut(true, $data);
        return $msgOut;
    }
}
