<?php

namespace App\Http\SingleActions\Backend\Headquarters\Merchant\Platform;

use App\Models\Systems\SystemPlatform;
use Illuminate\Http\JsonResponse;

/**
 * Class for merchant admin user do add action.
 */
class DetailAction
{

    /**
     * Comment
     *
     * @var SystemPlatform
     */
    protected $model;

    /**
     * @param SystemPlatform $systemPlatform 代理商平台.
     */
    public function __construct(SystemPlatform $systemPlatform)
    {
        $this->model = $systemPlatform;
    }

    /**
     * @return JsonResponse
     */
    public function execute(): JsonResponse
    {
        $platformData = $this->model->with('owner')->get()->toArray();
        $msgOut       = msgOut(true, $platformData);
        return $msgOut;
    }
}
