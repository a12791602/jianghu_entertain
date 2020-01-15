<?php

namespace App\Http\Requests\Backend\Headquarters\SystemBank;

use App\Http\Requests\BaseFormRequest;

/**
 * Class EditRequest
 *
 * @package App\Http\Requests\Backend\Headquarters\SystemBank
 */
class EditRequest extends BaseFormRequest
{
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
        $myId = $this->get('id');
        return [
                'id'     => 'required|exists:system_banks,id',
                'name'   => 'required|unique:system_banks,name,' . $myId,
                'code'   => 'required|unique:system_banks,code,' . $myId,
                'status' => 'required|in:0,1',
               ];
    }

    /**
     * @return mixed[]
     */
    public function messages(): array
    {
        return [
                'id.required'     => 'ID不存在',
                'id.exists'       => 'ID不存在',
                'name.required'   => '请填写银行名称',
                'name.unique'     => '银行名称已存在',
                'code.required'   => '请填写银行编码',
                'code.unique'     => '银行编码已存在',
                'status.required' => '请选择状态',
                'status.in'       => '所选状态不再范围内',
               ];
    }
}
