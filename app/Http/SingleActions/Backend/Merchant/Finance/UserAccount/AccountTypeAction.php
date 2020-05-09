<?php

namespace App\Http\SingleActions\Backend\Merchant\Finance\UserAccount;

use App\Http\SingleActions\MainAction;
use App\Models\User\FrontendUsersAccountsTypesGroup;
use Illuminate\Http\JsonResponse;

/**
 * Class AccountTypeAction
 * @package App\Http\SingleActions\Backend\Merchant\Finance\UserAccount
 */
class AccountTypeAction extends MainAction
{
    /**
     * @return JsonResponse
     */
    public function execute(): JsonResponse
    {
        $data = FrontendUsersAccountsTypesGroup::with('accountType:id,name,sign,group_type_id')
            ->get(
                [
                 'id',
                 'group_name',
                ],
            );
        return msgOut($data);
    }
}
