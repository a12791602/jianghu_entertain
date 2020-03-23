<?php

namespace App\Http\Requests\Backend\Merchant\GameVendor;

use App\Http\Requests\BaseFormRequest;

/**
 * Class SortRequest
 * @package App\Http\Requests\Backend\Merchant\GameVendor
 */
class SortRequest extends BaseFormRequest
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
     * @return array
     */
    public function rules(): array
    {
        return [
            'sorts'        => 'required|array',
            'sorts.*.id'   => 'required|integer|exists:game_vendor_platforms,id',
            'sorts.*.sort' => 'required|integer|min:1',
        ];
    }
    public function messages(): array
    {
        return [
            'sorts.required'        => '请上传排序数据',
            'sorts.json'            => '排序数据不符合规范',
            'sorts.*.id.required'   => '排序ID不存在',
            'sorts.*.id.integer'    => '排序ID不符合规范',
            'sorts.*.id.exists'     => '排序ID不存在',
            'sorts.*.sort.required' => '请上传排序值',
            'sorts.*.sort.integer'  => '排序值不符合规范',
            'sorts.*.sort.min'      => '排序值最小为1',
        ];
    }
    /**
     * @return array
     */
    public function filters(): array
    {
        return [
            'sorts' => 'cast:array',
        ];
    }
}
