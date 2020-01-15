<?php

namespace App\Http\SingleActions\Backend\Headquarters\Email;

use App\Models\Email\SystemEmail;

/**
 * Class BaseAction
 *
 * @package App\Http\SingleActions\Backend\Headquarters\Email
 */
class BaseAction
{

    /**
     * @var SystemEmail $model
     */
    protected $model;

    /**
     * BaseAction constructor.
     *
     * @param SystemEmail $systemEmail SystemEmail.
     */
    public function __construct(SystemEmail $systemEmail)
    {
        $this->model = $systemEmail;
    }
}
