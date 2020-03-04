<?php

namespace App\Http\Requests\Backend\Headquarters\GameType;

use App\Http\Requests\BaseFormRequest;

/**
 * Class EditRequest
 *
 * @package App\Http\Requests\Backend\Headquarters\GameType
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
        $myId  = $this->get('id');
        $rules = [
                  'id'   => 'required|exists:game_types,id',
                  'name' => 'required|unique:game_types,name,' . $myId,
                  'sign' => 'required|regex:/\w+/|unique:game_types,sign,' . $myId,
                 ];
        return $rules;
    }

    /**
     * @return mixed[]
     */
    public function messages(): array
    {
        $message = [
                    'id.required'   => 'ID不存在',
                    'id.exists'     => 'ID不存在',
                    'name.required' => '请填写游戏种类名称',
                    'name.unique'   => '游戏种类名称已存在',
                    'sign.required' => '请填写游戏种类标记',
                    'sign.regex'    => '游戏种类标记只能包含数字,字母,下划线',
                    'sign.unique'   => '游戏种类标记已存在',
                   ];
        return $message;
    }
}
