<?php

/**
 * Created by PhpStorm.
 * author: Harris
 * Date: 6/5/2019
 * Time: 8:06 PM
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Waavi\Sanitizer\Laravel\SanitizesInput;

/**
 * Class for base form request.
 */
abstract class BaseFormAbstractRequest extends FormRequest
{
    use SanitizesInput;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return mixed[]
     */
    abstract public function rules(): array;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return boolean
     */
    abstract public function authorize(): bool;

    /**
     * validateResolved
     * @return void
     */
    public function validateResolved(): void
    {
        {
            $this->sanitize();
            parent::validateResolved();
        }
    }
}
