<?php

namespace App\Http\SingleActions\Backend\Headquarters\Merchant\Platform;

use App\Http\SingleActions\MainAction;
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
        $platformData = $this->model->filter($inputDatas)->with('owner.accessGroup.detail')
            ->get(
                [
                 'id',
                 'cn_name',
                 'sign',
                 'agency_method',
                 'pc_skin_id',
                 'h5_skin_id',
                 'app_skin_id',
                 'start_time',
                 'end_time',
                 'sms_num',
                 'maintain_start',
                 'maintain_end',
                 'status',
                 'created_at',
                 'owner_id',
                ],
            );
        $returnData   = [];
        foreach ($platformData as $item) {
            if (isset($item->owner->accessGroup->detail)) {
                $role = $item->owner->accessGroup->detail->pluck('menu_id')->toArray();
            } else {
                $role = [];
            }
            $createdAt    = $item->created_at !== null ? $item->created_at->toDatetimeString() : null;
            $returnData[] = [
                             'id'             => $item->id,
                             'cn_name'        => $item->cn_name,
                             'email'          => $item->owner->email ?? '',
                             'sign'           => $item->sign,
                             'agency_method'  => $item->agency_method,
                             'pc_skin_id'     => $item->pc_skin_id,
                             'h5_skin_id'     => $item->h5_skin_id,
                             'app_skin_id'    => $item->app_skin_id,
                             'start_time'     => $item->start_time,
                             'end_time'       => $item->end_time,
                             'sms_num'        => $item->sms_num,
                             'maintain_start' => $item->maintain_start,
                             'maintain_end'   => $item->maintain_end,
                             'status'         => $item->status,
                             'created_at'     => $createdAt,
                             'role'           => $role,
                            ];
        }//end foreach
        return msgOut($returnData);
    }
}
