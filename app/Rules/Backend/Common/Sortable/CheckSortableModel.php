<?php

namespace App\Rules\Backend\Common\Sortable;

use App\Http\Requests\BaseFormRequest;
use App\Models\Game\GameSubType;
use App\Models\Game\GameType;
use Illuminate\Contracts\Validation\Rule;

/**
 * Class CheckSortableModel
 * @package App\Rules
 */
class CheckSortableModel implements Rule
{

    // GameType::class
    public const GAME_TYPE = 1;

    // GameSubType::class
    public const GAME_SUB_TYPE = 2;

    /**
     * @var BaseFormRequest $request
     */
    protected $request;

    /**
     * CheckSortableModel constructor.
     * @param BaseFormRequest $request BaseFormRequest.
     */
    public function __construct(BaseFormRequest $request)
    {
        $this->request = $request;
    }

    /**
     * Determine if the validation rule passes.
     * @param  string $model_type Model_type.
     * @param  string $value      Value.
     * @return boolean
     */
    public function passes($model_type, $value): bool
    {
        unset($model_type);
        $model = null;
        switch ($value) {
            case self::GAME_TYPE:
                $model = GameType::class;
                break;
            case self::GAME_SUB_TYPE:
                $model = GameSubType::class;
                break;
        }
        $this->request->attributes->add(['model' => $model]);
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return '模型类型错误';
    }
}
