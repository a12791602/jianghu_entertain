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
    public function messages(): array
    {
        return [
                'id.required'       => 'ID不存在',
                'id.exists'         => 'ID不存在',
                'type_id.required'  => '请选择入款类型',
                'type_id.exists'    => '所选入款类型不存在',
                'bank_id.exists'    => '所选银行不存在',
                'bank_id.unique'    => '该银行类型已绑定银行卡',
                'name.required'     => '请填写名称',
                'name.unique'       => '名称已存在',
                'username.required' => '请填写姓名',
                'account.required'  => '请填写卡号',
                'account.unique'    => '卡号已存在',
                'branch.string'     => '支行名称不符合规则',
                'min.required'      => '请填写最低入款金额',
                'min.integer'       => '最低入款金额必须是整数',
                'min.min'           => '最低入款金额不能小于1元',
                'max.required'      => '请填写最高入款金额',
                'max.integer'       => '最高入款金额必须是整数',
                'max.gt'            => '最高入款金额必须大于最低入款金额',
                'fee.numeric'       => '手续费不符合规则',
                'fee.min'           => '手续费不能小于0元',
                'tags.array'        => '用户标签不符合规则',
                'tags.*'            => '用户标签不存在',
                'remark.string'     => '说明不符合规则',
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
