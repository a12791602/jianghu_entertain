<?php

namespace App\Http\Requests\Backend\Merchant\Notice\Login;

use App\Http\Requests\BaseFormRequest;
use App\Services\FactoryService;

/**
 * Class IndexRequest
 * @package App\Http\Requests\Backend\Merchant\Notice\Login
 */
class IndexRequest extends BaseFormRequest
{
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
                'title'  => 'string|max:64',
                'device' => 'required|in:' . $const::DEVICE_PC . ',' . $const::DEVICE_H5 . ',' . $const::DEVICE_APP,
               ];
    }

    /**
     * @return mixed[]
     */
    public function messages(): array
    {
        return [
                'device.required' => '请选择设备',
                'device.in'       => '所选设备不在范围内',
               ];
    }
}
