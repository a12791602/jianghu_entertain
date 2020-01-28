<?php

namespace App\Http\Requests\Frontend\Common;

use App\Http\Requests\BaseFormRequest;
use App\Models\Platform\GamesPlatform;

/**
 * Class GameListRequest
 * @package App\Http\Requests\Frontend\Common
 */
class GameListRequest extends BaseFormRequest
{

    /**
     * @var array 需要依赖模型中的字段备注信息
     */
    protected $dependentModels = [GamesPlatform::class];

    /**
     * @var array 自定义字段 【此字段在数据库中没有的字段字典】
     */
    protected $extraDefinition = ['aa' => '自定义字段'];

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
                'device'  => 'integer|required',
                'type_id' => 'integer',
                'is_hot'  => 'integer',
                'aa'      => 'required',
               ];
    }

    /**
     * Get custom messages for validator errors.
     * @return mixed[]
     */
    //    public function messages(): array
    //    {
    //        return [
    //                'device.integer'  => '设备类型不符合规则',
    //                'type_id.integer' => '游戏分类ID不符合规则',
    //                'is_hot.integer'  => '游戏分类是否热门不符合规则',
    //               ];
    //    }
}
