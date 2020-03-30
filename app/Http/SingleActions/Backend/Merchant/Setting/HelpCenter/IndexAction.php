<?php

namespace App\Http\SingleActions\Backend\Merchant\Setting\HelpCenter;

use App\Http\SingleActions\MainAction;
use App\ModelFilters\System\SystemUsersHelpCenterFilter;
use App\Models\Systems\SystemUsersHelpCenter;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * 帮助设置-列表
 */
class IndexAction extends MainAction
{

    /**
     * @var object
     */
    protected $model;

    /**
     * @param SystemUsersHelpCenter $systemUsersHelpCenter 帮助中心Model.
     * @param Request               $request               Request.
     * @throws \Exception Exception.
     */
    public function __construct(SystemUsersHelpCenter $systemUsersHelpCenter, Request $request)
    {
        parent::__construct($request);
        $this->model = $systemUsersHelpCenter;
    }

    /**
     * @param array $inputDatas 接收的参数.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $inputDatas['sign']     = $this->currentPlatformEloq->sign;
        $inputDatas['data_pid'] = 0;
        $result                 = $this->model
            ->filter($inputDatas, SystemUsersHelpCenterFilter::class)
            ->with(
                [
                 'childs.author',
                 'childs.newer',
                ],
            )
            ->select(
                [
                 'id',
                 'pid',
                 'title',
                 'type',
                 'status',
                 'created_at',
                 'updated_at',
                ],
            )->paginate($this->model::getPageSize())->toArray();
        $data                   = [];
        foreach ($result['data'] as $helpDatas) {
            $childs = [];
            foreach ($helpDatas['childs'] as $item) {
                $childs[] = [
                             'id'         => $item['id'],
                             'pid'        => $item['pid'],
                             'title'      => $item['title'],
                             'pic'        => $item['pic'],
                             'status'     => $item['status'],
                             'author'     => $item['author']['name'] ?? '',
                             'newer'      => $item['newer']['name'] ?? '',
                             'created_at' => $item['created_at'],
                             'updated_at' => $item['updated_at'],
                            ];
            }
            $data[] = [
                       'id'         => $helpDatas['id'],
                       'title'      => $helpDatas['title'],
                       'status'     => $helpDatas['status'],
                       'created_at' => $helpDatas['created_at'],
                       'updated_at' => $helpDatas['updated_at'],
                       'childs'     => $childs,
                      ];
        }
        $result['data'] = $data;
        $msgOut         = msgOut($result);
        return $msgOut;
    }
}
