<?php

namespace App\Http\Requests\Backend\Headquarters\SystemBank;

use App\Http\Requests\BaseFormRequest;
use App\Models\Finance\SystemBank;

/**
 * Class DelDoRequest
 *
 * @package App\Http\Requests\Backend\Headquarters\SystemBank
 */
class DelDoRequest extends BaseFormRequest
{
    
    /**
     * @var array 需要依赖模型中的字段备注信息
     */
    protected $dependentModels = [SystemBank::class];
    
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
        return ['id' => 'required|exists:system_banks,id'];
    }
}
