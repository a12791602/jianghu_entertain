<?php

namespace App\Rules;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

/**
 * Class CustomUnique
 * @package App\Rules
 */
class CustomUnique implements Rule
{

    /**
     * @var BaseFormRequest $request
     */
    protected $request;

    /**
     * @var string $table
     */
    protected $table;

    /**
     * @var integer $myId
     */
    protected $myId;

    /**
     * @var string $field
     */
    protected $field;

    /**
     * CustomUnique constructor.
     * @param BaseFormRequest $request Request.
     * @param string          $table   Table.
     * @param string          $field   Field.
     * @param integer         $myId    MyId.
     */
    public function __construct(BaseFormRequest $request, string $table, string $field, int $myId = 0)
    {
        $this->request = $request;
        $this->table   = $table;
        $this->myId    = $myId;
        $this->field   = $field;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute Attribute.
     * @param mixed  $value     Value.
     * @return boolean
     */
    public function passes($attribute, $value): bool
    {
        $auth          = auth($this->request->currentGuard);
        $user          = $auth->user();
        $platform_sign = $user->platform->sign;
        if ($this->field === 'platform_id') {
            $platform_sign = $user->platform->id;
        }
        $result = DB::table($this->table)
            ->where($this->field, $platform_sign)
            ->where($attribute, $value)
            ->first();
        if ((int) $this->myId !== 0) {
            $result = DB::table($this->table)
                ->where($this->field, $platform_sign)
                ->where($attribute, $value)
                ->where('id', '!=', $this->myId)
                ->first();
        }
        return $result === null;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return '名称已存在';
    }
}
