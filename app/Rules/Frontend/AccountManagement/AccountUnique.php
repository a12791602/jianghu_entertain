<?php

namespace App\Rules\Frontend\AccountManagement;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Contracts\Validation\Rule;

/**
 * Class AccountUnique
 * @package App\Rules\Frontend\AccountManagement
 */
class AccountUnique implements Rule
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
        $user      = $this->request->user();
        $condition = $user->bankCard->where($attribute, $value)->isEmpty();
        return $condition === true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return '该账户已存在.';
    }
}
