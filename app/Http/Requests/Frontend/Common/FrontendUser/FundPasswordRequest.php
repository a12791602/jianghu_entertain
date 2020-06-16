<?php

namespace App\Http\Requests\Frontend\Common\FrontendUser;

use App\Http\Requests\BaseFormRequest;
use App\Models\User\FrontendUser;

/**
 * Class FundPasswordRequest
 * @package App\Http\Requests\Frontend\Common\FrontendUser
 */
class FundPasswordRequest extends BaseFormRequest
{

    /**
     * @var array 需要依赖模型中的字段备注信息
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
                'fund_password' => [
                                    'required',
                                    'confirmed',
                                    //(必须存在大写+小写+数字的7到15位)
                                    'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d].{7,15}$/',
                                   ],
               ];
    }
}
