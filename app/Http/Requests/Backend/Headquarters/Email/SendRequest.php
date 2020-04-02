<?php

namespace App\Http\Requests\Backend\Headquarters\Email;

use App\Http\Requests\BaseFormRequest;
use App\Models\Email\SystemEmail;

/**
 * Class SendRequest
 *
 * @package App\Http\Requests\Backend\Headquarters\Email
 */
class SendRequest extends BaseFormRequest
{

    /**
     * @var array 需要依赖模型中的字段备注信息
     */
    protected $dependentModels = [SystemEmail::class];

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
        $reveiverRule = 'required|string|min:1|max:64|distinct|email:rfc,dns|exists:merchant_admin_users,email';
        return [
                'receivers'   => 'required|array',
                'receivers.*' => $reveiverRule,
                'title'       => 'required|string|min:1|max:16',
                'content'     => 'required|string|min:1|max:1000',
                'is_timing'   => 'required|integer|in:' . SystemEmail::IS_TIMING_NO . ',' . SystemEmail::IS_TIMING_YES,
                'send_time'   => 'integer|digits:10|required_if:is_timing,' . SystemEmail::IS_TIMING_YES,
               ];
    }

    /**
     * @return mixed[]
     */
    public function filters(): array
    {
        return ['receivers' => 'cast:array'];
    }
}
