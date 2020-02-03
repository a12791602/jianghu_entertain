<?php

namespace App\Http\Requests\Frontend\H5\Recharge;

use App\Http\Requests\BaseFormRequest;
use App\Models\Finance\SystemFinanceType;

/**
 * Class TypesRequest
 * @package App\Http\Requests\Frontend\H5\Recharge
 */
class TypesRequest extends BaseFormRequest
{

    /**
     * @var array 需要依赖模型中的字段备注信息
     */
    protected $dependentModels = [SystemFinanceType::class];

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
        $isOnlineRule = 'integer|in:' . SystemFinanceType::IS_ONLINE_NO . ',' . SystemFinanceType::IS_ONLINE_YES;
        return ['is_online' => $isOnlineRule];
    }
}
