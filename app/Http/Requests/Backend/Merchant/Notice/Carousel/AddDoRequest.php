<?php

namespace App\Http\Requests\Backend\Merchant\Notice\Carousel;

use App\Http\Requests\BaseFormRequest;
use App\JHHYLibs\JHHYCnst;
use App\Models\Notice\NoticeCarousel;

/**
 * Class AddDoRequest
 * @package App\Http\Requests\Backend\Merchant\Notice\Carousel
 */
class AddDoRequest extends BaseFormRequest
{

    /**
     * @var array 需要依赖模型中的字段备注信息
     */
    protected $dependentModels = [NoticeCarousel::class];

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
        $devCriteria = 'required|in:' . JHHYCnst::DEVICE_PC . ',' . JHHYCnst::DEVICE_H5 . ',' . JHHYCnst::DEVICE_APP;
        return [
                'title'      => 'required|string|max:64',
                'pic_id'     => 'required|integer|exists:static_resources,id',
                'type'       => 'required|in:' . NoticeCarousel::TYPE_INSIDE . ',' . NoticeCarousel::TYPE_OUTER,
                'link'       => 'required_if:type,' . NoticeCarousel::TYPE_INSIDE . '|string|max:128',
                'start_time' => 'required|date',
                'end_time'   => 'required|date|after:start_time',
                'status'     => 'required|in:' . JHHYCnst::STATUS_DISABLE . ',' . JHHYCnst::STATUS_OPEN,
                'device'     => $devCriteria,
               ];
    }
}
