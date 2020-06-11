<?php

namespace App\Http\Requests\Backend\Merchant\Finance\Online;

use App\Http\Requests\BaseFormRequest;
use App\Models\Finance\SystemFinanceOnlineInfo;
use App\Rules\CustomUnique;

/**
 * Class EditRequest
 * @package App\Http\Requests\Backend\Merchant\Finance\Online
 */
class EditRequest extends BaseFormRequest
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
        $myId   = $this->get('id');
        $unique = new CustomUnique($this, 'system_finance_online_infos', 'platform_sign', $myId);
        return [
                'id'              => 'required|exists:system_finance_online_infos,id',
                'channel_id'      => 'required|exists:system_finance_channels,id',
                'frontend_name'   => [
                                      'required',
                                      $unique,
                                     ],
                'merchant_code'   => 'required',
                'merchant_no'     => 'string',
                'encrypt_mode'    => 'required|in:'
                . SystemFinanceOnlineInfo::ENCRYPT_MODE_SECRET
                . ',' . SystemFinanceOnlineInfo::ENCRYPT_MODE_CERT,
                'certificate'     => 'required_if:encrypt_mode,2|string|min:1|max:256',
                'merchant_secret' => 'string',
                'public_key'      => 'string',
                'private_key'     => 'string',
                'request_url'     => 'required|url',
                'vendor_url'      => 'url',
                'app_id'          => 'string',
                'tags'            => 'array',
                'tags.*'          => 'exists:users_tags,id',
                'min_amount'      => 'required|integer',
                'max_amount'      => 'required|integer|gt:min_amount',
                'handle_fee'      => 'integer',
                'desc'            => 'string',
                'backend_remark'  => 'string',
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
