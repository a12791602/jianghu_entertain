<?php

namespace App\Http\Requests\Backend\Merchant\Email;

use App\Http\Requests\BaseFormRequest;
use App\Models\Email\SystemEmailSend;

/**
 * Class DestroySentEmailRequest
 * @package App\Http\Requests\Backend\Merchant\Email
 */
class DestroySentEmailRequest extends BaseFormRequest
{

    /**
     * @var array 需要依赖模型中的字段备注信息
     */
    protected $dependentModels = [SystemEmailSend::class];

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
        return ['email_id' => 'required|array|min:1|exists:system_email_sends,email_id'];
    }

    /**
     * @return mixed[]
     */
    public function filters(): array
    {
        return ['email_id' => 'cast:array'];
    }
}
