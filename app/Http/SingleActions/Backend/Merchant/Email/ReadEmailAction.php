<?php

namespace App\Http\SingleActions\Backend\Merchant\Email;

use App\Models\Email\SystemEmail;
use App\Models\Email\SystemEmailOfMerchant;
use Illuminate\Http\JsonResponse;

/**
 * Class ReadEmailAction
 * @package App\Http\SingleActions\Backend\Merchant\Email
 */
class ReadEmailAction
{
    /**
     * @param array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $result = SystemEmailOfMerchant::where('id', $inputDatas['id'])
            ->update(['is_read' => SystemEmail::IS_READ_YES]);
        if ($result) {
            $msgOut = msgOut();
            return $msgOut;
        }
        throw new \Exception('303002');
    }
}
