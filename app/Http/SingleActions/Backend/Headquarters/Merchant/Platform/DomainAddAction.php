<?php

namespace App\Http\SingleActions\Backend\Headquarters\Merchant\Platform;

use App\Http\Controllers\BackendApi\BackEndApiMainController;
use App\Models\Systems\SystemDomain;
use Illuminate\Http\JsonResponse;

/**
 * Class for merchant admin user do add action.
 */
class DomainAddAction
{
    
    /**
     * @var SystemDomain
     */
    protected $model;

    /**
     * @param SystemDomain $systemDomain 域名.
     */
    public function __construct(SystemDomain $systemDomain)
    {
        $this->model = $systemDomain;
    }

    /**
     * @param  BackEndApiMainController $contll     Controller.
     * @param  array                    $inputDatas 接收的参数.
     * @throws \Exception Exception.
     * @return JsonResponse
     */
    public function execute(BackEndApiMainController $contll, array $inputDatas): JsonResponse
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
                $contll->currentAdmin->id,
            );
        } else {
            $result = $this->model->insertDomain($inputDatas);
        }
        if ($result !== true) {
            throw new \Exception($result);
        }
        $msgOut = msgOut(true, ['domain' => $inputDatas['domain']]);
        return $msgOut;
    }
}
