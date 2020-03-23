<?php

namespace App\Http\Requests\Backend\Merchant\Admin\MerchantAdminUser;

use App\Http\Requests\BaseFormRequest;
use App\Models\Admin\MerchantAdminUser;

/**
 * Class for create request.
 */
class CreateRequest extends BaseFormRequest
{
    
    /**
     * @var array 需要依赖模型中的字段备注信息
     */
    protected $dependentModels = [MerchantAdminUser::class];
    
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
                'name'     => 'required|string|max:16|unique:merchant_admin_users',
                'email'    => 'required|string|max:64|email|unique:merchant_admin_users',
                'password' => [
                               'required',
                               'string',
                               'regex:/^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{8,16}$/',//(必须存在大小写字母+数字的8-16位)
                              ], //密码
                'group_id' => 'required|integer|exists:merchant_admin_access_groups,id',
               ];
    }
}
