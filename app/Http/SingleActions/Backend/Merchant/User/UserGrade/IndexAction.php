<?php

namespace App\Http\SingleActions\Backend\Merchant\User\UserGrade;

use App\Models\User\UsersGrade;
use Illuminate\Http\JsonResponse;

/**
 * 用户等级-列表
 */
class IndexAction
{

    /**
     * @var object
     */
    protected $model;

    /**
     * @param UsersGrade $usersGrade 用户等级Model.
     */
    public function __construct(UsersGrade $usersGrade)
    {
        $this->model = $usersGrade;
    }

    /**
     * @param  string $sign 平台标识.
     * @return JsonResponse
     */
    public function execute(string $sign): JsonResponse
    {
        $data   = $this->model
                     ->select('id', 'name', 'experience_min', 'experience_max', 'grade_gift', 'week_gift', 'updated_at')
                     ->where('platform_sign', $sign)
                     ->orderBy('experience_max', 'asc')
                     ->get()
                     ->toArray();
        $msgOut = msgOut($data);
        return $msgOut;
    }
}
