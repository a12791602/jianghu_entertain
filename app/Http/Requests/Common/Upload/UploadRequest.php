<?php

namespace App\Http\Requests\Common\Upload;

use App\Http\Requests\BaseFormRequest;

/**
 * Class UploadRequest
 * @package App\Http\Requests\Common\Upload
 */
class UploadRequest extends BaseFormRequest
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
        $file    = config('upload.input_name', 'file');
        $maxSize = config('upload.max_size', 2048);
        $mimes   = config('upload.mimes', '*');
        return [
            $file => 'required|file|max:' . $maxSize . '|mimetypes:' . $mimes,
            'basket' => 'string',
        ];
    }

    /**
     * @return mixed[]
     */
    public function messages(): array
    {
        $file = config('upload.input_name', 'file');
        return [
            $file . '.required' => '请上传文件',
            $file . '.file' => '请上传文件',
            $file . '.mimetypes' => '所传文件格式不在范围内',
            $file . '.max' => '所传文件大小不在范围内',
        ];
    }
}
