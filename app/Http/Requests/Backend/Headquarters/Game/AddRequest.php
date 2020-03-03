<?php

namespace App\Http\Requests\Backend\Headquarters\Game;

use App\Http\Requests\BaseFormRequest;

/**
 * Class AddRequest
 *
 * @package App\Http\Requests\Backend\Headquarters\Game
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
                  'type_id'      => 'required|exists:game_types,id',
                  'vendor_id'    => 'required|exists:game_vendors,id',
                  'name'         => 'required|unique:games,name',
                  'sign'         => 'required|unique:games,sign|regex:/\w+/',
                  'request_mode' => 'required|integer|in:1,2',
                  'status'       => 'required|in:0,1',
                 ];
        return $rules;
    }

    /**
     * @return mixed[]
     */
    public function messages(): array
    {
        $message = [
                    'type_id.required'      => '请选择所属分类',
                    'type_id.exists'        => '所选分类不存在',
                    'vendor_id.required'    => '请选择所属厂商',
                    'vendor_id.exists'      => '所选厂商不存在',
                    'name.required'         => '请填写游戏名称',
                    'name.unique'           => '游戏名称已存在',
                    'sign.required'         => '请填写游戏标记',
                    'sign.unique'           => '游戏标记已存在',
                    'sign.regex'            => '游戏标记只能包含数字,字母,下划线',
                    'request_mode.required' => '请选择请求模式',
                    'request_mode.integer'  => '请求模式不正确',
                    'request_mode.in'       => '请求模式不正确',
                    'status.required'       => '请选择状态',
                    'status.in'             => '所选状态不正确',
                   ];
        return $message;
    }
}
