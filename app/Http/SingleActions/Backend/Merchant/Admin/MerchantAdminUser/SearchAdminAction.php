<?php

namespace App\Http\SingleActions\Backend\Merchant\Admin\MerchantAdminUser;

use App\Http\SingleActions\MainAction;
use App\ModelFilters\Admin\MerchantAdminUserFilter;
use App\Models\Admin\MerchantAdminUser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class for search admin action.
 */
class SearchAdminAction extends MainAction
{

    /**
     * @var object
     */
    protected $model;

    /**
     * @param MerchantAdminUser $merchantAdminUser MerchantAdminUser.
     * @param Request           $request           Request.
     * @throws \Exception Exception.
     */
    public function __construct(MerchantAdminUser $merchantAdminUser, Request $request)
    {
        parent::__construct($request);
        $this->model = $merchantAdminUser;
    }

    /**
     * @param array $inputDatas 接收的参数.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $inputDatas['platform'] = $this->currentPlatformEloq->sign;
        $data                   = $this->model->filter($inputDatas, MerchantAdminUserFilter::class)->get()->toArray();
        $msgOut                 = msgOut($data);
        return $msgOut;
    }
}
