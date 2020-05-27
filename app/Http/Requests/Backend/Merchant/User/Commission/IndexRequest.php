<?php

namespace App\Http\Requests\Backend\Merchant\User\Commission;

use App\Http\Requests\BaseFormRequest;
use App\Models\User\UsersCommissionConfig;

/**
 * 洗码列表
 */
class IndexRequest extends BaseFormRequest
{

    /**
     * @var array 需要依赖模型中的字段备注信息
     */
    protected $dependentModels = [UsersCommissionConfig::class];

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
                'game_type'   => 'required|string|max:32', //游戏类型标识
                'game_vendor' => 'required|string|max:32', //游戏平台标识
               ];
    }
}
