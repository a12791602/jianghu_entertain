<?php

namespace App\Http\SingleActions\Backend\Merchant\User\FrontendUser;

use App\ModelFilters\User\FrontendUserFilter;
use App\Models\User\FrontendUser;
use Illuminate\Http\JsonResponse;

/**
 * 会员列表
 */
class IndexAction
{

    /**
     * @var object
     */
    protected $model;

    /**
     * @param FrontendUser $frontendUser 用户Model.
     */
    public function __construct(FrontendUser $frontendUser)
    {
        $this->model = $frontendUser;
    }

    /**
     * @param array $inputDatas 接收的参数.
     * @return JsonResponse
     * @throws \RuntimeException Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        if (isset($inputDatas['pageSize'])) {
            $this->model->setPerPage($inputDatas['pageSize']);
        }
        if (isset($inputDatas['parent_mobile'])) {
            $filterArr = ['mobile' => $inputDatas['parent_mobile']];
            $parentId  = $this->model->filter($filterArr, FrontendUserFilter::class)->first();
            if ($parentId !== null) {
                $inputDatas['parentId'] = $parentId->id;
            }
        }
        $datas = $this->model->filter($inputDatas, FrontendUserFilter::class)
            ->select(
                [
                 'id',
                 'mobile',
                 'parent_id',
                 'is_online',
                 'is_tester',
                 'guid',
                 'user_tag_id',
                 'register_ip',
                 'last_login_ip',
                 'last_login_time',
                 'created_at',
                ],
            )
            ->with(
                [
                 'userTag:id,title',
                 'specificInfo:user_id,total_members',
                 'parent:id,mobile',
                 'account:user_id,balance',
                ],
            )
            ->paginate()->toArray();
        $datas = $this->_handleData($datas);
        return msgOut($datas);
    }

    /**
     * handleData description
     * @param  array $datas 需要处理的会员列表数据.
     * @return mixed[]
     */
    private function _handleData(array $datas): array
    {
        foreach ($datas['data'] as $userKey => $user) {
            $datas['data'][$userKey] = [
                                        'id'              => $user['id'],
                                        'mobile'          => $user['mobile_hidden'],
                                        'guid'            => $user['guid'],
                                        'is_online'       => $user['is_online'],
                                        'is_tester'       => $user['is_tester'],
                                        'register_ip'     => $user['register_ip'],
                                        'last_login_ip'   => $user['last_login_ip'],
                                        'last_login_time' => $user['last_login_time'],
                                        'created_at'      => $user['created_at'],
                                        'user_tag'        => $user['user_tag']['title'] ?? null,
                                        'total_members'   => $user['specific_info']['total_members'] ?? 0,
                                        'parent_mobile'   => $user['parent']['mobile'] ?? null,
                                        'balance'         => $user['account']['balance'] ?? 0,
                                       ];
        }
        return $datas;
    }
}
