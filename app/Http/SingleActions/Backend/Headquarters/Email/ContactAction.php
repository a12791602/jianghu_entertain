<?php

namespace App\Http\SingleActions\Backend\Headquarters\Email;

use App\Models\Admin\MerchantAdminUser;
use Illuminate\Http\JsonResponse;

/**
 * Class ContactAction
 * @package App\Http\SingleActions\Backend\Headquarters\Email
 */
class ContactAction extends BaseAction
{
    /**
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(): JsonResponse
    {
        $data   = MerchantAdminUser::with('platform:id,name,sign')->select(['id', 'email', 'platform_sign'])->get();
        $msgOut = msgOut($data);
        return $msgOut;
    }
}
