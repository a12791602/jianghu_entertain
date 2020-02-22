<?php

namespace App\Http\SingleActions\Backend\Headquarters\Admin\BackendAdminUser;

use App\Http\SingleActions\MainAction;
use App\ModelFilters\Admin\BackendAdminUserFilter;
use App\Models\Admin\MerchantAdminUser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class for search admin action.
 */
class SearchAdminAction extends MainAction
{

    /**
     * @var object $model MerchantAdminUser.
     */
    protected $model;

    /**
     * @param Request           $request           Request.
     * @param MerchantAdminUser $merchantAdminUser MerchantAdminUser.
     */
    public function __construct(
        Request $request,
        MerchantAdminUser $merchantAdminUser
    ) {
        parent::__construct($request);
        $this->model = $merchantAdminUser;
    }

    /**
     * @param array $inputDatas 接收的参数.
     * @return JsonResponse
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $data   = $this->model->filter($inputDatas, BackendAdminUserFilter::class)->get()->toArray();
        $msgOut = msgOut($data);
        return $msgOut;
    }
}
