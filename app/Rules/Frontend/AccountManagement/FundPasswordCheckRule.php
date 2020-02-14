<?php

namespace App\Rules\Frontend\AccountManagement;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;

/**
 * Class FundPasswordCheckRule
 * @package App\Rules\Frontend\AccountManagement
 */
class FundPasswordCheckRule implements Rule
{

    /**
     * @var BaseFormRequest $request BaseFormRequest.
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
     *
     * @param  string $attribute Card_number.
     * @param  mixed  $value     Bank card number.
     * @return boolean
     */
    public function passes($attribute, $value): bool
    {
        unset($attribute);
        $request       = $this->request;
        $fund_password = $request->user()->fund_password;
        $checked       = Hash::check($value, $fund_password);
        return $checked === true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return '取款密码不正确。';
    }
}
