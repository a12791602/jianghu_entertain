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
     * @param array $inputData InputData.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputData): JsonResponse
    {
        $email = SystemEmailOfMerchant::where('email_id', $inputData['id'])->first();
        if (!$email instanceof SystemEmailOfMerchant) {
            return msgOut();
        }
        $email->update(['is_read' => SystemEmail::IS_READ_YES]);
        return msgOut($email->email);
    }
}
