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
    public function authorize():bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules():array
    {
        if ($this->isMethod('post')) {
            return [
                'type_id' => 'required|exists:games_types,id',
                'vendor_id' => 'required|exists:games_vendors,id',
                'name' => 'required|unique:games,name',
                'sign' => ['required','unique:games,sign','regex:/\w+/'],
                'request_mode' => 'required|integer|in:1,2',
                'conver_url' => 'required|url',
                'test_conver_url' => 'url',
                'check_balance_url' => 'required|url',
                'test_check_balance_url' => 'url',
                'check_order_url' => 'required|url',
                'test_check_order_url' => 'url',
                'in_game_url' => 'required|url',
                'test_in_game_url' => 'url',
                'get_station_order_url' => 'required|url',
                'test_get_station_order_url' => 'url',
                'status' => 'required|in:0,1',
                'app_id' => 'string|nullable',
                'authorization_code' => 'string',
                'merchant_code' => 'string',
                'merchant_secret' => 'string',
                'public_key' => 'string',
                'private_key' => 'string',
            ];
        }
        return [];
    }

    /**
     * @return array
     */
    public function messages():array
    {
        return [
            'type_id.required' => '请选择所属分类',
            'type_id.exists' => '所选分类不存在',
            'vendor_id.required' => '请选择所属厂商',
            'vendor_id.exists' => '所选厂商不存在',
            'name.required' => '请填写游戏名称',
            'name.unique' => '游戏名称已存在',
            'sign.required' => '请填写游戏标记',
            'sign.unique' => '游戏标记已存在',
            'sign.regex' => '游戏标记只能包含数字,字母,下划线',
            'request_mode.required' => '请选择请求模式',
            'request_mode.integer' => '请求模式不正确',
            'request_mode.in' => '请求模式不正确',
            'conver_url.required' => '请填写上下分地址',
            'conver_url.url' => '上下分地址格式不正确',
            'test_conver_url.url' => '测试上下分地址格式不正确',
            'check_balance_url.required' => '请填写获取余额地址',
            'check_balance_url.url' => '获取余额地址格式不正确',
            'test_check_balance_url.url' => '测试获取余额地址格式不正确',
            'check_order_url.required' => '请填写检测订单地址',
            'check_order_url.url' => '检测订单地址格式不正确',
            'test_check_order_url.url' => '测试检测订单地址格式不正确',
            'in_game_url.required' => '请填写进入游戏地址',
            'in_game_url.url' => '进入游戏地址格式不正确',
            'test_in_game_url.url' => '测试进入游戏地址格式不正确',
            'get_station_order_url.required' => '请填写获取注单地址',
            'get_station_order_url.url' => '获取注单地址格式不正确',
            'test_get_station_order_url.url' => '测试获取注单地址格式不正确',
            'status.required' => '请选择状态',
            'status.in' => '所选状态不正确',
        ];
    }
}
