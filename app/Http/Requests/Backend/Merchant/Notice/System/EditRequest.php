<?php

namespace App\Http\Requests\Backend\Merchant\Notice\System;

use App\Http\Requests\BaseFormRequest;
use App\Lib\Constant\JHHYCnst;
use App\Models\Notice\NoticeSystem;

/**
 * Class EditRequest
 * @package App\Http\Requests\Backend\Merchant\Notice\System
 */
class EditRequest extends BaseFormRequest
{

    /**
     * @var array 需要依赖模型中的字段备注信息
     */
    protected $dependentModels = [NoticeSystem::class];

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
                'id'         => 'required|integer|exists:notice_systems,id',
                'title'      => 'required|string|max:64',
                'h5_pic_id'  => 'integer|exists:static_resources,id',
                'app_pic_id' => 'integer|exists:static_resources,id',
                'pc_pic_id'  => 'integer|exists:static_resources,id',
                'start_time' => 'required|date',
                'end_time'   => 'required|date|after:start_time',
                'status'     => 'required|in:' . JHHYCnst::STATUS_DISABLE . ',' . JHHYCnst::STATUS_OPEN,
               ];
    }
}
