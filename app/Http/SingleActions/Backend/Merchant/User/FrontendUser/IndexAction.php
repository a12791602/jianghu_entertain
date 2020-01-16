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
     */
    public function execute(array $inputDatas): JsonResponse
    {
        if (isset($inputDatas['parent_mobile'])) {
            $filterArr = ['mobile' => $inputDatas['parent_mobile']];
            $parentId  = $this->model->filter($filterArr, FrontendUserFilter::class)->first();
            if ($parentId !== null) {
                $inputDatas['parentId'] = $parentId->id;
            }
        }
        $data   = $this->model->filter($inputDatas, FrontendUserFilter::class)->paginate($this->model::getPageSize());
        $msgOut = msgOut($data);
        return $msgOut;
    }
}
