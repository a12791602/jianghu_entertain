<?php

namespace App\Http\Requests\Backend\Merchant\Finance\Online;

use App\Http\Requests\BaseFormRequest;
use App\Models\Finance\SystemFinanceOnlineInfo;

/**
 * Class IndexRequest
 * @package App\Http\Requests\Backend\Merchant\Finance\Online
 */
class IndexRequest extends BaseFormRequest
{

    /**
     * @var array 需要依赖模型中的字段备注信息
     */
    protected $dependentModels = [SystemFinanceOnlineInfo::class];

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
        return [
                'merchant_code'    => 'string',
                'frontend_name'    => 'string',
                'merchant_no'      => 'string',
                'author_name'      => 'string',
                'created_at'       => 'array',
                'created_at.*'     => 'date',
                'last_editor_name' => 'string',
                'updated_at'       => 'array',
                'updated_at.*'     => 'date',
                'pageSize'         => 'integer|between:1,100',     //每页数据条数
               ];
    }

    /**
     * @return mixed[]
     */
    public function filters(): array
    {
        return [
                'created_at' => 'cast:array',
                'updated_at' => 'cast:array',
               ];
    }
}
