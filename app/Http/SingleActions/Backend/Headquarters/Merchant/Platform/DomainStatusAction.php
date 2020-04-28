<?php

namespace App\Http\SingleActions\Backend\Headquarters\Merchant\Platform;

use App\Http\SingleActions\MainAction;
use App\Models\Systems\SystemDomain;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class for domain status action.
 */
class DomainStatusAction extends MainAction
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
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $domainEloq = $this->model->find($inputDatas['id']);
        if (!$domainEloq instanceof $this->model) {
            throw new \Exception('302009');
        }
        $domainEloq->status = $inputDatas['status'];
        if ($domainEloq->save() === false) {
            throw new \Exception('302010');
        }
        return msgOut();
    }
}
