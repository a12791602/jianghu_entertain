<?php

namespace App\Http\Requests\Backend\Headquarters\Game\GameVendor;

use App\Http\Requests\BaseFormRequest;
use App\Models\Game\GameVendor;
use Illuminate\Http\Request;

/**
 * Class EditDoRequest
 *
 * @package App\Http\Requests\Backend\Headquarters\GameVendor
 */
class EditDoRequest extends BaseFormRequest
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
     * @return mixed[]
     */
    public function rules(): array
    {
        $myId  = $this->get('id');
        $rules = [
                  'id'                 => 'required|exists:game_vendors,id',
                  'name'               => 'required|unique:game_vendors,name,' . $myId,
                  'sign'               => 'required|string|max:6|unique:game_vendors,sign,' . $myId,
                  'whitelist_ips'      => 'required|array',
                  'whitelist_ips.*'    => 'ip',
                  'urls'               => 'required|array',
                  'urls.*'             => 'url',
                  'test_urls'          => 'array',
                  'test_urls.*'        => 'url',
                  'app_id'             => 'string|max:128',
                  'authorization_code' => 'string|max:10',
                  'merchant_id'        => 'string|max:10',
                  'merchant_secret'    => 'string|max:128',
                  'public_key'         => 'string|max:2048',
                  'private_key'        => 'string|max:2048',
                  'des_key'            => 'string|max:64',
                  'md5_key'            => 'string|max:32',
                  'status'             => 'required|in:0,1',
                 ];

        return $rules;
    }

    /**
     * @return array
     */
    public function filters(): array
    {
        return ['whitelist_ips' => 'cast:array'];
    }
}
