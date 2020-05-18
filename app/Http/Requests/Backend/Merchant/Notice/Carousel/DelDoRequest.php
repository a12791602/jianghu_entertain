<?php

namespace App\Http\Requests\Backend\Merchant\Notice\Carousel;

use App\Http\Requests\BaseFormRequest;
use App\Models\Notice\NoticeCarousel;

/**
 * Class DelDoRequest
 * @package App\Http\Requests\Backend\Merchant\Notice\Carousel
 */
class DelDoRequest extends BaseFormRequest
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
        return ['id' => 'required|integer|exists:notice_carousels'];
    }
}
