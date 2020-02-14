<?php

namespace App\Http\Requests\Backend\Merchant\Finance\Online;

use App\Http\Requests\BaseFormRequest;
use App\Models\Finance\SystemFinanceOnlineInfo;
use App\Rules\CustomUnique;

/**
 * Class AddDoRequest
 * @package App\Http\Requests\Backend\Merchant\Finance\Online
 */
class AddDoRequest extends BaseFormRequest
{

    /**
     * @var array 需要依赖模型中的字段备注信息
     */
    protected $dependentModels = [SystemFinanceOnlineInfo::class];

    /**
     * @var array 自定义字段 【此字段在数据库中没有的字段字典】
     */
    protected $extraDefinition = ['tags' => '会员标签'];

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
        $unique = new CustomUnique($this, 'system_finance_online_infos', 'platform_sign');
        return [
                'channel_id'      => 'required|integer|exists:system_finance_channels,id',
                'frontend_name'   => [
                                      'required',
                                      'string',
                                      $unique,
                                     ],
                'merchant_code'   => 'required|string|min:1|max:128',
                'merchant_no'     => 'string|min:1|max:128',
                'encrypt_mode'    => 'required|integer|in:'
                . SystemFinanceOnlineInfo::ENCRYPT_MODE_SECRET
                . ',' . SystemFinanceOnlineInfo::ENCRYPT_MODE_CERT,
                'merchant_secret' => 'string|min:1|max:256',
                'public_key'      => 'string|min:1|max:2048',
                'private_key'     => 'string|min:1|max:2048',
                'request_url'     => 'required|string|min:5|max:256|url',
                'vendor_url'      => 'url|string|min:5|max:256',
                'app_id'          => 'string|min:1|max:256',
                'tags'            => 'array',
                'tags.*'          => 'exists:users_tags,id',
                'min'             => 'required|integer|min:1',
                'max'             => 'required|integer|gt:min',
                'handle_fee'      => 'integer|gt:0',
                'desc'            => 'string|min:1|max:256',
                'backend_remark'  => 'string|min:1|max:256',
               ];
    }

    /**
     * @return mixed[]
     */
    public function filters(): array
    {
        return ['tags' => 'cast:array'];
    }
}
