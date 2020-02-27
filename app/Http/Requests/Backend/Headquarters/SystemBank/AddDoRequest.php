<?php

namespace App\Http\Requests\Backend\Headquarters\SystemBank;

use App\Http\Requests\BaseFormRequest;
use App\Models\Finance\SystemBank;

/**
 * Class AddDoRequest
 *
 * @package App\Http\Requests\Backend\Headquarters\SystemBank
 */
class AddDoRequest extends BaseFormRequest
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
        return [
                'name'   => 'required|unique:system_banks,name',
                'code'   => 'required|unique:system_banks,code',
                'status' => 'required|in:0,1',
               ];
    }
}
