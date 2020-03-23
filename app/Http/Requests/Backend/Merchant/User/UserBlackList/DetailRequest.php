<?php

namespace App\Http\Requests\Backend\Merchant\User\UserBlackList;

use App\Http\Requests\BaseFormRequest;
use App\Models\User\FrontendUsersBlackList;

/**
 * 黑名单详情
 */
class DetailRequest extends BaseFormRequest
{

    /**
     * @var array 需要依赖模型中的字段备注信息
     */
    protected $dependentModels = [FrontendUsersBlackList::class];

    /**
     * @var array 自定义字段 【此字段在数据库中没有的字段字典】
     */
    protected $extraDefinition = ['createAt' => '进入黑名单时间'];

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
                'guid'         => 'required|exists:frontend_users_black_lists', //用户UID
                'status'       => 'integer|in:0,1',                             //状态  0拉黑 1解封
                'created_at'   => 'array|size:2',                               //进入黑名单日期
                'created_at.*' => 'date',                                       //进入黑名单日期
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
