<?php

namespace App\Http\Requests\Backend\Merchant\Activity\Statically;

use App\Http\Requests\BaseFormRequest;
use App\Models\Activity\SystemStaticActivity;
use App\Services\FactoryService;

/**
 * Class StatusRequest
 * @package App\Http\Requests\Backend\Merchant\Notice\Carousel
 */
class StatusRequest extends BaseFormRequest
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
        $const = FactoryService::getInstence()->generateService('constant');
        return [
                'id'     => 'required|exists:system_static_activities,id',
                'status' => 'required|in:' . $const::STATUS_DISABLE . ',' . $const::STATUS_NORMAL,
               ];
    }
}
