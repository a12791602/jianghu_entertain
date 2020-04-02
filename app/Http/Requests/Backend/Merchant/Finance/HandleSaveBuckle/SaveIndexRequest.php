<?php

namespace App\Http\Requests\Backend\Merchant\Finance\HandleSaveBuckle;

use App\Http\Requests\BaseFormRequest;
use App\Models\Finance\SystemFinanceHandleSaveBuckleRecord;

/**
 * Class SaveIndexRequest
 * @package App\Http\Requests\Backend\Merchant\Finance\HandleSaveBuckle
 */
class SaveIndexRequest extends BaseFormRequest
{

    /**
     * @var array 需要依赖模型中的字段备注信息
     */
    protected $dependentModels = [SystemFinanceHandleSaveBuckleRecord::class];

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
        $type = array_keys(SystemFinanceHandleSaveBuckleRecord::$saveTypes);
        return [
                'mobile'       => 'string|size:11|regex:/^1[345789]\d{9}$/',//(手机号码第一位1第二位345789总共11位数字)
                'guid'         => 'string|size:7',
                'is_tester'    => 'integer|in:0,1',
                'type'         => 'integer|in:' . implode(',', $type),
                'created_at'   => 'array',
                'created_at.*' => 'required|date',
                'pageSize'     => 'integer|between:1,100',     //每页数据条数
               ];
    }

    /**
     * @return mixed[]
     */
    public function filters(): array
    {
        return ['created_at' => 'cast:array'];
    }
}
