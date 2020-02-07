<?php

namespace App\Http\SingleActions\Backend\Headquarters\Merchant\Platform;

use App\Http\SingleActions\MainAction;
use App\Models\Systems\SystemDomain;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class for merchant admin user do add action.
 */
class DomainAddAction extends MainAction
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
     * @throws \Exception Exception.
     * @return JsonResponse
     */
    public function execute(array $inputDatas): JsonResponse
    {
        //域名格式检查
        /*$checkDomainPrefix = $this->model->checkDomainPrefix($inputDatas['domain'], $inputDatas['type']);
        if ($checkDomainPrefix === false) {
        throw new \Exception('302002');
        }*/

        if ((int) $inputDatas['type'] === $this->model::TYPE_MAIN) {
            //如果是主域名  需要添加所有类型的子域名
            $result = $this->model->insertAllTypeDomain(
                $inputDatas['domain'],
                $inputDatas['platform_sign'],
                $this->user->id,
            );
        } else {
            $result = $this->model->insertDomain($inputDatas);
        }
        if ($result !== true) {
            throw new \Exception($result);
        }
        $msgOut = msgOut(['domain' => $inputDatas['domain']]);
        return $msgOut;
    }
}
