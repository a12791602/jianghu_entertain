<?php

namespace App\Http\SingleActions\Backend\Headquarters\Merchant\Platform;

use App\Http\SingleActions\MainAction;
use App\ModelFilters\System\SystemDomainFilter;
use App\Models\Systems\SystemDomain;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class for merchant admin user do add action.
 */
class DomainDetailAction extends MainAction
{
    
    /**
     * @var SystemDomain
     */
    protected $model;

    /**
     * @param Request      $request      Request.
     * @param SystemDomain $systemDomain 域名.
     */
    public function __construct(
        Request $request,
        SystemDomain $systemDomain
    ) {
        parent::__construct($request);
        $this->model = $systemDomain;
    }

    /**
     * @param  array $inputDatas 接收的参数.
     * @return JsonResponse
     */
    public function execute(array $inputDatas): JsonResponse
    {
        if (isset($inputDatas['pageSize'])) {
            $this->model->setPerPage($inputDatas['pageSize']);
        }
        $data = $this->model
            ->filter($inputDatas, SystemDomainFilter::class)
            ->paginate();
        return msgOut($data);
    }
}
