<?php

namespace App\Http\Requests\Backend\Merchant\User\UserBlackList;

use App\Http\Requests\BaseFormRequest;
use App\Models\User\FrontendUsersBlackList;

/**
 * 黑名单列表
 */
class IndexRequest extends BaseFormRequest
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
                'mobile'   => ['regex' => 'regex:/^1[345789]\d{9}$/'], //(手机号码第一位1第二位345789总共11位数字)
                'guid'     => 'string',                                //用户UID
                'createAt' => 'string',                                //进入黑名单日期
               ];
    }
}
