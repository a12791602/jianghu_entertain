<?php

namespace App\Rules\Frontend;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;

/**
 * Class CheckSecurityCode
 * @package App\Rules
 */
class SecurityCodeCheckRule implements Rule
{

    /**
     * @var BaseFormRequest $request
     */
    protected $request;
    /**
     * Check user security code rule instance.
     * @param BaseFormRequest $request Request.
     * @return void
     */
    public function __construct(BaseFormRequest $request)
    {
        $this->request = $request;
    }

    /**
     * Determine if the validation rule passes.
     * @param  string $attribute Security_code.
     * @param  string $value     Value.
     * @return boolean
     */
    public function passes($attribute, $value): bool
    {
        unset($attribute);
        $request       = $this->request;
        $security_code = $request->user($request->get('guard'))->security_code;
        $checked       = Hash::check($value, $security_code);
        return $checked === true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return '安全码错误，请重新输入。';
    }
}
