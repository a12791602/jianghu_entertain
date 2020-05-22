<?php

namespace App\Http\Requests\Backend\Merchant\Email;

use App\Http\Requests\BaseFormRequest;
use App\Models\Email\SystemEmail;

/**
 * Class ReceivedIndexRequest
 * @package App\Http\Requests\Backend\Merchant\Email
 */
class ReceivedIndexRequest extends BaseFormRequest
{

    /**
     * @var array 需要依赖模型中的字段备注信息
     */
    protected $dependentModels = [SystemEmail::class];

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
                'title'        => 'string|min:1|max:16',
                'sender'       => 'string|min:1|max:30',
                'send_time'    => 'date',
                'created_at'   => 'array',
                'created_at.*' => 'date',
                'pageSize'     => 'integer|between:1,100',     //每页数据条数
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
