<?php

namespace App\Http\Requests\Backend\Headquarters\GameType;

use App\Http\Requests\BaseFormRequest;

/**
 * Class AddRequest
 *
 * @package App\Http\Requests\Backend\Headquarters\GameType
 */
class AddRequest extends BaseFormRequest
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
        $rules = [
                  'name'   => 'required|unique:game_types,name',
                  'sign'   => 'required|regex:/\w+/|unique:game_types,sign',
                  'status' => 'required|in:0,1',
                 ];
        return $rules;
    }

    /**
     * @return mixed[]
     */
    public function messages(): array
    {
        $messages = [
                     'name.required'   => '请填写游戏种类名称',
                     'name.unique'     => '游戏种类名称已存在',
                     'sign.required'   => '请填写游戏种类标记',
                     'sign.regex'      => '游戏种类标记只能包含数字,字母,下划线',
                     'sign.unique'     => '游戏种类标记已存在',
                     'status.required' => '请选择状态',
                     'status.in'       => '所选择状态不存在',
                    ];
        return $messages;
    }
}
