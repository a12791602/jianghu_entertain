<?php

namespace App\Http\SingleActions\Backend\Headquarters\Merchant\Platform;

use App\Http\SingleActions\MainAction;
use App\Models\Systems\SystemPlatformSkin;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * 皮肤列表
 */
class SkinListAction extends MainAction
{

    /**
     * Comment
     *
     * @var SystemPlatformSkin
     */
    protected $model;

    /**
     * @param Request            $request            Request.
     * @param SystemPlatformSkin $systemPlatformSkin 平台皮肤.
     */
    public function __construct(
        Request $request,
        SystemPlatformSkin $systemPlatformSkin
    ) {
        parent::__construct($request);
        $this->model = $systemPlatformSkin;
    }

    /**
     * @return JsonResponse
     */
    public function execute(): JsonResponse
    {
        $skinData = SystemPlatformSkin::get(
            [
             'id',
             'name',
             'type',
            ],
        );
        $msgOut   = msgOut($skinData);
        return $msgOut;
    }
}
