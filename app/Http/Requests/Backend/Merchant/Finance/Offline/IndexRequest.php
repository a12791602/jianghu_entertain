<?php

namespace App\Http\Requests\Backend\Merchant\Finance\Offline;

use App\Http\Requests\BaseFormRequest;
use App\Models\Finance\SystemFinanceOfflineInfo;

/**
 * Class IndexRequest
 * @package App\Http\Requests\Backend\Merchant\Finance\Offline
 */
class IndexRequest extends BaseFormRequest
{

    /**
     * @var array 需要依赖模型中的字段备注信息
     */
    protected $dependentModels = [SystemFinanceOfflineInfo::class];

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
                'type_id'          => 'integer|exists:system_finance_types,id',
                'name'             => 'string|min:1|max:128',
                'account'          => 'string|min:1|max:128',
                'username'         => 'string|min:1|max:128',
                'author_name'      => 'string|min:1|max:128',
                'created_at'       => 'array',
                'created_at.*'     => 'date',
                'last_editor_name' => 'string|min:1|max:128',
                'updated_at'       => 'array',
                'updated_at.*'     => 'date',
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
