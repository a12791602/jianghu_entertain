<?php

namespace App\Http\SingleActions\Backend\Headquarters\Email;

use App\Models\Email\SystemEmailOfMerchant;
use Illuminate\Http\JsonResponse;

/**
 * Class RecentContactAction
 * @package App\Http\SingleActions\Backend\Headquarters\Email
 */
class RecentContactAction extends BaseAction
{
    /**
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(): JsonResponse
    {
        $data   = SystemEmailOfMerchant::with('merchant:id,email')
            ->limit(4)
            ->select('merchant_id')
            ->get();
        $msgOut = msgOut($data);
        return $msgOut;
    }
}
