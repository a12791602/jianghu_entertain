<?php

namespace App\Http\Requests\Frontend\Common;

use App\Http\Requests\BaseFormRequest;
use App\Models\User\FrontendUser;

/**
 * Class RegisterRequest
 * @package App\Http\Requests\Frontend\Common
 */
class RegisterRequest extends BaseFormRequest
{

    /**
     * 需要依赖模型中的字段备注信息
     * @var array<int,string>
     */
    protected $dependentModels = [FrontendUser::class];

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
        return [
                'invite_code'       => 'integer',
                'password'          => [
                                        'required',
                                        'confirmed',
                                        'regex:/^[0-9A-Za-z]{8,16}$/',//(英文字母||数字 8到16位)
                                       ],
                'verification_key'  => 'required|string',
                'verification_code' => 'required|string',
               ];
    }
}
