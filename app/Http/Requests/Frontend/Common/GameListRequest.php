<?php

namespace App\Http\Requests\Frontend\Common;

use App\Http\Requests\BaseFormRequest;
use App\Models\Platform\GamePlatform;

/**
 * Class GameListRequest
 * @package App\Http\Requests\Frontend\Common
 */
class GameListRequest extends BaseFormRequest
{

    /**
     * @var array 需要依赖模型中的字段备注信息
     */
    protected $dependentModels = [GamePlatform::class];

    /**
     * @var array 自定义字段 【此字段在数据库中没有的字段字典】
     */
    //protected $extraDefinition = ['aa' => '自定义字段'];

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
        return ['device' => 'required|integer|in:1,2,3'];
    }
}
