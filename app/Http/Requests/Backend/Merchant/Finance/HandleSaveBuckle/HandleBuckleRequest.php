<?php

namespace App\Http\Requests\Backend\Merchant\Finance\HandleSaveBuckle;

use App\Http\Requests\BaseFormRequest;
use App\Models\Finance\SystemFinanceHandleSaveBuckleRecord;

/**
 * Class HandleBuckleRequest
 * @package App\Http\Requests\Backend\Merchant\Finance\HandleSaveBuckle
 */
class HandleBuckleRequest extends BaseFormRequest
{

    /**
     * @var array 需要依赖模型中的字段备注信息
     */
    protected $dependentModels = [SystemFinanceHandleSaveBuckleRecord::class];

    /**
     * @var array 自定义字段 【此字段在数据库中没有的字段字典】
     */
    protected $extraDefinition = ['user' => '会员帐号或会员ID'];

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
        $types = array_keys(SystemFinanceHandleSaveBuckleRecord::$buckleTypes);
        $types = implode(',', $types);
        $rules = [
                  'user'   => 'required|string|min:1|max:32',
                  'type'   => 'required|integer|in:' . $types,
                  'money'  => 'required|numeric|gt:0',
                  'remark' => 'string|min:1|max:256',
                 ];
        return $rules;
    }
}
