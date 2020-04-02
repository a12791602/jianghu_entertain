<?php

namespace App\Http\Requests\Backend\Merchant\Game;

use App\Http\Requests\BaseFormRequest;

/**
 * Class IndexRequest
 * @package App\Http\Requests\Backend\Merchant\Game
 */
class IndexRequest extends BaseFormRequest
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
        return [
                'device'    => 'integer|in:1,2,3',          //服务端 1.PC 2.H5 3.APP
                'vendor_id' => 'integer|exists:game_vendors,id',
                'name'      => 'string|max:64',
                'type_id'   => 'required_unless:hot_new,1|integer|exists:game_types,id',
                'status'    => 'integer|in:0,1',
                'hot_new'   => 'integer|in:0,1',
                'pageSize'  => 'integer|between:1,100',     //每页数据条数
               ];
    }

    /**
     * @return mixed[]
     */
    public function messages(): array
    {
        return [
                'vendor_id.exists'        => '游戏平台不存在',
                'name.string'             => '游戏名称不符合规则',
                'type_id.required_unless' => '请选择游戏分类',
                'type_id.exists'          => '所选游戏分类不存在',
                'status.in'               => '所选状态不在范围内',
                'hot_new.in'              => '所选是否热门不在范围内',
               ];
    }
}
