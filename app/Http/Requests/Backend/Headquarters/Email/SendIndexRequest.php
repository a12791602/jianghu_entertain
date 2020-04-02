<?php

namespace App\Http\Requests\Backend\Headquarters\Email;

use App\Http\Requests\BaseFormRequest;
use App\Models\Email\SystemEmail;

/**
 * Class SendIndexRequest
 * @package App\Http\Requests\Backend\Headquarters\Email
 */
class SendIndexRequest extends BaseFormRequest
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
                'name'         => 'string|min:1|max:32',
                'is_send'      => 'integer|in:' . SystemEmail::IS_SEND_NO . ',' . SystemEmail::IS_SEND_YES,
                'created_at'   => 'array',
                'created_at.*' => 'date',
                'pageSize'     => 'integer|between:1,100', //每页数据条数
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
