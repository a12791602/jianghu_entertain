<?php

namespace App\Http\Requests\Backend\Headquarters\Game\GameVendor;

use App\Http\Requests\BaseFormRequest;
use App\Models\Game\GameVendor;

/**
 * Class AddDoRequest
 *
 * @package App\Http\Requests\Backend\Headquarters\GameVendor
 */
class AddDoRequest extends BaseFormRequest
{

    /**
     * @var array 需要依赖模型中的字段备注信息
     */
    protected $dependentModels = [GameVendor::class];

    /**
     * @var array 自定义字段 【此字段在数据库中没有的字段字典】
     */
    protected $extraDefinition = [
        'whitelist_ips.*' => '白名单',
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
     * @return array
     */
    public function rules(): array
    {
        $result = [
                   'name'               => 'required|unique:game_vendors,name',
                   'sign'               => 'required|string|unique:game_vendors,sign|max:6',
                   'whitelist_ips'      => 'array',
                   'whitelist_ips.*'    => 'ip',
                   'type_id'            => 'required|integer',
                   'urls'               => 'required|array',
                   'urls.*'             => 'url',
                   'test_urls'          => 'array',
                   'test_urls.*'        => 'url',
                   'app_id'             => 'string|nullable',
                   'authorization_code' => 'string',
                   'merchant_id'        => 'string',
                   'merchant_secret'    => 'string',
                   'public_key'         => 'string',
                   'private_key'        => 'string',
                   'des_key'            => 'string',
                   'md5_key'            => 'string',
                   'status'             => 'required|in:0,1',
                  ];
        return $result;
    }

    /**
     * @return array
     */
    public function filters(): array
    {
        return [
            'whitelist_ips' => 'cast:array',
        ];
    }
}
