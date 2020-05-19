<?php

namespace App\Http\Requests\Backend\Merchant\Bank;

use App\Http\Requests\BaseFormRequest;
use App\Lib\Constant\JHHYCnst;
use App\Models\Finance\SystemPlatformBank;

/**
 * Class StatusRequest
 * @package App\Http\Requests\Backend\Merchant\Bank
 */
class StatusRequest extends BaseFormRequest
{

    /**
     * @var array 需要依赖模型中的字段备注信息
     */
    protected $dependentModels = [SystemPlatformBank::class];

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
                'id'     => 'required|integer|exists:system_platform_banks,id',
                'status' => 'required|integer|in:' . JHHYCnst::STATUS_DISABLE . ',' . JHHYCnst::STATUS_OPEN,
               ];
    }
}
