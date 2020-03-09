<?php

namespace App\Http\Requests\Backend\Headquarters\FinanceVendor;

use App\Http\Requests\BaseFormRequest;
use App\Models\Finance\SystemFinanceVendor;

/**
 * Class AddDoRequest
 *
 * @package App\Http\Requests\Backend\Headquarters\FinanceVendor
 */
class AddDoRequest extends BaseFormRequest
{

    /**
     * 需要依赖模型中的字段备注信息
     * @var array<int,string>
     */
    protected $dependentModels = [SystemFinanceVendor::class];

    /**
     * 自定义字段 【此字段在数据库中没有的字段字典】
     * @var array<string,string>
     */
    protected $extraDefinition = [
        'whitelist_ips.*' => '白名单',
    ];

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
        $rules = [
                  'name'            => 'required|unique:system_finance_vendors,name',
                  'sign'            => 'required|alpha_dash|unique:system_finance_vendors,sign',
                  'whitelist_ips'   => 'array',
                  'whitelist_ips.*' => 'ip',
                  'status'          => 'required|in:0,1',
                 ];
        return $rules;
    }

    /**
     * @return array
     */
    public function filters():array
    {
        return [
            'whitelist_ips' => 'cast:array',
        ];
    }
}
