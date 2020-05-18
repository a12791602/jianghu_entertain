<?php

namespace App\Http\Requests\Backend\Merchant\Notice\Marquee;

use App\Http\Requests\BaseFormRequest;
use App\JHHYLibs\JHHYCnst;
use App\Models\Notice\NoticeMarquee;

/**
 * Class AddDoRequest
 * @package App\Http\Requests\Backend\Merchant\Notice\Marquee
 */
class AddDoRequest extends BaseFormRequest
{

    /**
     * @var array 需要依赖模型中的字段备注信息
     */
    protected $dependentModels = [NoticeMarquee::class];
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
                'title'      => 'required|string|max:16',
                'content'    => 'required|string',
                'device'     => 'required|array',
                'device.*'   => 'in:' . JHHYCnst::DEVICE_PC . ',' . JHHYCnst::DEVICE_H5 . ',' . JHHYCnst::DEVICE_APP,
                'status'     => 'in:' . JHHYCnst::STATUS_DISABLE . ',' . JHHYCnst::STATUS_OPEN,
                'start_time' => 'required|date',
                'end_time'   => 'required|date|after:start_time',
               ];
    }

    /**
     * @return mixed[]
     */
    public function filters(): array
    {
        return ['device' => 'cast:array'];
    }
}
