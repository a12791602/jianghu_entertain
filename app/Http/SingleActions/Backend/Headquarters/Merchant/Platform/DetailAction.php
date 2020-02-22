<?php

namespace App\Http\SingleActions\Backend\Headquarters\Merchant\Platform;

use App\Http\SingleActions\MainAction;
use App\ModelFilters\System\SystemPlatformFilter;
use App\Models\Systems\SystemPlatform;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class for merchant admin user do add action.
 */
class DetailAction extends MainAction
{

    /**
     * Comment
     *
     * @var SystemPlatform
     */
    protected $model;

    /**
     * @param Request        $request        Request.
     * @param SystemPlatform $systemPlatform 代理商平台.
     */
    public function __construct(
        Request $request,
        SystemPlatform $systemPlatform
    ) {
        parent::__construct($request);
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
            ->select(
                [
                 'id',
                 'cn_name',
                 'sign',
                 'agency_method',
                 'start_time',
                 'end_time',
                 'sms_num',
                 'maintain_start',
                 'maintain_end',
                 'status',
                 'created_at',
                 'owner_id',
                ],
            )
            ->with('owner:id,email')
            ->get();
        $msgOut       = msgOut($platformData);
        return $msgOut;
    }
}
