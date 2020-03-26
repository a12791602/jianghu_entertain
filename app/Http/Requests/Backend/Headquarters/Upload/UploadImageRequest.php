<?php

namespace App\Http\Requests\Backend\Headquarters\Upload;

use App\Http\Requests\BaseFormRequest;

/**
 * Class UploadRequest
 * @package App\Http\Requests\Common\Upload
 */
class UploadImageRequest extends BaseFormRequest
{

    /**
     * 自定义字段 【此字段在数据库中没有的字段字典】
     * @var array<string,string>
     */
    protected $extraDefinition = [
                                  'file' => '图片',
                                  'path' => '路径',
                                 ];

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
        $maxSize = config('upload.max_size', 2048);
        $mimes   = config('upload.mimes', '*');
        $rules   = [
                    'file' => 'required|file|max:' . $maxSize . '|mimetypes:' . $mimes,
                    'path' => 'required|string',
                   ];
        return $rules;
    }
}
