<?php

namespace App\Http\Requests\Backend\Merchant\User\Commission;

use App\Http\Requests\BaseFormRequest;

/**
 * 洗码列表
 */
class IndexRequest extends BaseFormRequest
{

    /**
     * @var array 自定义字段 【此字段在数据库中没有的字段字典】
     */
    protected $extraDefinition = [
                                  'gameTypeId'   => '游戏类型ID',
                                  'gameVendorId' => '游戏平台ID',
                                 ];

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
                'gameTypeId'   => 'required|integer', //游戏类型ID
                'gameVendorId' => 'required|integer', //游戏平台ID
               ];
    }
}
