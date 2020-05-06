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
                                  'whitelist_ips.*'             => '白名单',
                                  'production.app_id'           => '终端号',
                                  'production.des_key'          => 'des 秘钥',
                                  'production.md5_key'          => 'md5 秘钥',
                                  'production.merchant_id'      => '商户号',
                                  'production.public_key'       => '公钥',
                                  'production.private_key'      => '私钥',
                                  'production.merchant_secret'  => '商户秘钥',
                                  'production.third_party_urls' => '存放三方调用测试urls',
                                  'staging.app_id'              => '终端号',
                                  'staging.des_key'             => 'des 秘钥',
                                  'staging.md5_key'             => 'md5 秘钥',
                                  'staging.merchant_id'         => '商户号',
                                  'staging.public_key'          => '公钥',
                                  'staging.private_key'         => '私钥',
                                  'staging.merchant_secret'     => '商户秘钥',
                                  'staging.third_party_urls'    => '存放三方调用测试urls',
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
        $myId = $this->get('id');
        return [
                'id'                            => 'required|exists:game_vendors,id',
                'name'                          => 'required|unique:game_vendors,name,' . $myId,
                'sign'                          => 'required|string|max:6|unique:game_vendors,sign,' . $myId,
                'whitelist_ips'                 => 'required|array',
                'whitelist_ips.*'               => 'ip',
                'authorization_code'            => 'string|max:10',
                'status'                        => 'required|in:0,1',
                'type_id'                       => 'required|integer|exists:game_types,id',
                'production'                    => 'array',
                'production.app_id'             => 'string|max:128',
                'production.merchant_id'        => 'required|string|max:10',
                'production.public_key'         => 'required_without_all:production.merchant_secret,production.md5_key|string|max:2048',
                'production.private_key'        => 'required_without_all:production.merchant_secret,production.md5_key|string|max:2048',
                'production.merchant_secret'    => 'required_without_all:production.public_key,production.private_key,production.md5_key|string|max:128',
                'production.md5_key'            => 'required_without_all:production.public_key,production.private_key,production.merchant_secret|string|max:32',
                'production.des_key'            => 'string|max:64',
                'production.url.*'              => 'url',
                'production.third_party_urls.*' => 'url',
                'staging'                       => 'array',
                'staging.app_id'                => 'string|max:128',
                'staging.merchant_id'           => 'string|max:10',
                'staging.public_key'            => 'string|max:2048',
                'staging.private_key'           => 'string|max:2048',
                'staging.merchant_secret'       => 'string|max:128',
                'staging.md5_key'               => 'string|max:32',
                'staging.des_key'               => 'string|max:64',
                'staging.url.*'                 => 'url',
                'staging.third_party_urls.*'    => 'url',
        ];
    }

    /**
     * @return array
     */
    public function filters(): array
    {
      return [
              'whitelist_ips'               => 'cast:array',
              'staging.third_party_urls'    => 'cast:array',
              'production.third_party_urls' => 'cast:array',
             ];
    }
}
