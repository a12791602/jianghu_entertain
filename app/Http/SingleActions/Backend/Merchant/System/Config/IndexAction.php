<?php

namespace App\Http\SingleActions\Backend\Merchant\System\Config;

use App\Http\SingleActions\MainAction;
use App\Models\Systems\SystemConfiguration;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * 全域设置-列表
 */
class IndexAction extends MainAction
{

    /**
     * @var object
     */
    protected $model;

    /**
     * @param SystemConfiguration $systemConfiguration 洗码Model.
     * @param Request             $request             Request.
     * @throws \Exception Exception.
     */
    public function __construct(SystemConfiguration $systemConfiguration, Request $request)
    {
        parent::__construct($request);
        $this->model = $systemConfiguration;
    }

    /**
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(): JsonResponse
    {
        $sign   = $this->currentPlatformEloq->sign;
        $data   = SystemConfiguration::where(
            [
             [
              'platform_sign',
              $sign,
             ],
             [
              'pid',
              0,
             ],
             [
              'display',
              SystemConfiguration::DISPLAY_YES,
             ],
            ],
        )->with('childs:id,pid,sign,name,status,value')->get(
            [
             'id',
             'name',
            ],
        );
        $msgOut = msgOut($data);
        return $msgOut;
    }
}
