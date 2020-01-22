<?php

namespace App\Http\SingleActions\Backend\Merchant\Email;

use App\Models\Email\SystemEmail;

/**
 * Class SendAction
 * @package App\Http\SingleActions\Backend\Merchant\Email
 */
class BaseAction
{

    /**
     * @var SystemEmail $model
     */
    protected $model;

    /**
     * BaseAction constructor.
     * @param SystemEmail $systemEmail 邮件.
     */
    public function __construct(SystemEmail $systemEmail)
    {
        $this->model = $systemEmail;
    }
}
