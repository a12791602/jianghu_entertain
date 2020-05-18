<?php

namespace App\Http\Requests\Backend\Merchant\Bank;

use App\Http\Requests\BaseFormRequest;
use App\JHHYLibs\JHHYCnst;
use App\Models\Finance\SystemPlatformBank;

/**
 * Class IndexRequest
 * @package App\Http\Requests\Backend\Merchant\Bank
 */
class IndexRequest extends BaseFormRequest
{

    /**
     * @var array 需要依赖模型中的字段备注信息
     */
    protected $dependentModels = [SystemPlatformBank::class];

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
                'name'     => 'string|max:32',
                'status'   => 'integer|in:' . JHHYCnst::STATUS_OPEN . ',' . JHHYCnst::STATUS_DISABLE,
                'pageSize' => 'integer|between:1,100',     //每页数据条数
               ];
    }
}
