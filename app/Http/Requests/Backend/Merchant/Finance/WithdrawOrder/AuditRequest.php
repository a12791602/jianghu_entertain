<?php

namespace App\Http\Requests\Backend\Merchant\Finance\WithdrawOrder;

use App\Http\Requests\BaseFormRequest;
use App\Models\User\FrontendUser;

/**
 * Class AuditRequest
 * @package App\Http\Requests\Backend\Merchant\Finance\WithdrawOrder
 */
class AuditRequest extends BaseFormRequest
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
                'guid'   => 'integer|exists:frontend_users,guid',
                'status' => 'in:0,1',
                'mobile' => [
                             'regex:/^1[345789]\d{9}$/',
                             'exists:frontend_users,mobile',
                            ],
               ];
    }
}
