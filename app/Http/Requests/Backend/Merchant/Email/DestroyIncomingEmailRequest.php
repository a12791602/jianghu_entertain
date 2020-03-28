<?php

namespace App\Http\Requests\Backend\Merchant\Email;

use App\Http\Requests\BaseFormRequest;
use App\Models\Email\SystemEmailOfMerchant;

/**
 * Class DestroyIncomingEmailRequest
 * @package App\Http\Requests\Backend\Merchant\Email
 */
class DestroyIncomingEmailRequest extends BaseFormRequest
{

    /**
     * @var array 需要依赖模型中的字段备注信息
     */
    protected $dependentModels = [SystemEmailOfMerchant::class];

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return boolean
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return mixed[]
     */
    public function rules(): array
    {
        $rules = ['email_id' => 'required|integer|min:1|exists:system_email_of_merchants,email_id'];
        return $rules;
    }
}
