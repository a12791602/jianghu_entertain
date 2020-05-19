<?php

namespace App\Http\Requests\Backend\Merchant\Activity\Statically;

use App\Http\Requests\BaseFormRequest;
use App\Lib\Constant\JHHYCnst;
use App\Models\Activity\SystemStaticActivity;

/**
 * Class IndexRequest
 * @package App\Http\Requests\Backend\Merchant\Notice\Carousel
 */
class IndexRequest extends BaseFormRequest
{

    /**
     * @var array 需要依赖模型中的字段备注信息
     */
    protected $dependentModels = [SystemStaticActivity::class];

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
        $deviceRule = 'required|in:' . JHHYCnst::DEVICE_PC . ',' . JHHYCnst::DEVICE_H5 . ',' . JHHYCnst::DEVICE_APP;
        return [
                'title'    => 'string',
                'device'   => $deviceRule,
                'pageSize' => 'integer|between:1,100',     //每页数据条数
               ];
    }
}
