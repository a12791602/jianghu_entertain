<?php

namespace App\Http\Requests\Backend\Merchant\Finance\UserAccount;

use App\Http\Requests\BaseFormRequest;
use App\Models\User\FrontendUser;
use App\Models\User\FrontendUsersAccountsReport;

/**
 * Class IndexRequest
 * @package App\Http\Requests\Backend\Merchant\Finance\UserAccount
 */
class IndexRequest extends BaseFormRequest
{

    /**
     * @var array 需要依赖模型中的字段备注信息
     */
    protected $dependentModels = [
                                  FrontendUsersAccountsReport::class,
                                  FrontendUser::class,
                                 ];

    /**
     * @var array 自定义字段 【此字段在数据库中没有的字段字典】
     */
    protected $extraDefinition = ['type_in' => '账变类型'];

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
                'mobile'       => 'string|size:11|regex:/^1[345789]\d{9}$/', //(手机号码第一位1第二位345789总共11位数字)
                'guid'         => 'string|max:16',                           //用户guid
                'type_in'      => 'array',                                   //账变类型
                'type_in.*'    => 'string|max:32',                           //账变类型sign
                'created_at'   => 'array|size:2',                            //账变时间
                'created_at.*' => 'required|date',                           //账变时间
                'pageSize'     => 'integer|between:1,100',                   //每页数据条数
               ];
    }

    /**
     * @return mixed[]
     */
    public function filters(): array
    {
        return [
                'created_at' => 'cast:array',
                'type_in'    => 'cast:array',
               ];
    }
}
