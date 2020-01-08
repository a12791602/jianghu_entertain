<?php

namespace App\Http\SingleActions\Backend\Headquarters\Merchant\Platform;

use App\ModelFilters\System\SystemPlatformFilter;
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
     * @param  array $inputDatas 接收的参数.
     * @return JsonResponse
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $platformData = $this->model
            ->filter($inputDatas, SystemPlatformFilter::class)
            ->with('owner')
            ->get()
            ->toArray();
        $msgOut       = msgOut(true, $platformData);
        return $msgOut;
    }
}
