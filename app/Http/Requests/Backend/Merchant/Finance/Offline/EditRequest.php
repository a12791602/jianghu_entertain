<?php

namespace App\Http\Requests\Backend\Merchant\Finance\Offline;

use App\Http\Requests\BaseFormRequest;
use App\Models\Finance\SystemFinanceOfflineInfo;

/**
 * Class EditRequest
 * @package App\Http\Requests\Backend\Merchant\Finance\Offline
 */
class EditRequest extends BaseFormRequest
{

    /**
     * @var array 需要依赖模型中的字段备注信息
     */
    protected $dependentModels = [SystemFinanceOfflineInfo::class];

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
        $myId = $this->get('id');
        if ($this->isMethod('post')) {
            return [
                    'id'         => 'required|integer|exists:system_finance_offline_infos,id',
                    'type_id'    => 'required|integer|exists:system_finance_types,id',
                    'bank_id'    => 'exists:system_banks,id|unique:system_finance_offline_infos,bank_id,' . $myId,
                    'username'   => 'required|string|min:1|max:128',
                    'qrcode'     => 'string|min:1',
                    'account'    => [
                                     'required',
                                     'string',
                                     'min:1',
                                     'max:256',
                                     'unique:system_finance_offline_infos,account,' . $myId,
                                    ],
                    'branch'     => 'string|min:1|max:128',
                    'min_amount' => 'required|integer|min:1',
                    'max_amount' => 'required|integer|gt:min_amount',
                    'fee'        => 'numeric|min:0',
                    'tags'       => 'array',
                    'tags.*'     => 'exists:users_tags,id',
                    'remark'     => 'string|min:1|max:256',
                   ];
        }
        return ['id' => 'required|exists:system_finance_offline_infos,id'];
    }

    /**
     * @return mixed[]
     */
    public function filters(): array
    {
        return ['tags' => 'cast:array'];
    }
}
