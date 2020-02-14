<?php

namespace App\Http\SingleActions\Frontend\Common\AccountManagement;

use App\Http\SingleActions\MainAction;
use Illuminate\Http\JsonResponse;

/**
 * Class RecordAction
 * @package App\Http\SingleActions\Frontend\Common\AccountManagement
 */
class FundPasswordCheckAction extends MainAction
{

    // Fund-password has been set.
    public const IS_SET_STATUS = 1;
    // Fund-password is not set.
    public const NO_SET_STATUS = 0;

    /**
     * Save user account information.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(): JsonResponse
    {
        $status = $this->user->fund_password ? self::IS_SET_STATUS : self::NO_SET_STATUS;
        $result = msgOut(['status' => $status]);
        return $result;
    }
}
