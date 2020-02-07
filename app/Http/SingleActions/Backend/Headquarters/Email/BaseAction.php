<?php

namespace App\Http\SingleActions\Backend\Headquarters\Email;

use App\Http\SingleActions\MainAction;
use App\Models\Email\SystemEmail;
use Illuminate\Http\Request;

/**
 * Class BaseAction
 *
 * @package App\Http\SingleActions\Backend\Headquarters\Email
 */
class BaseAction extends MainAction
{

    /**
     * @var SystemEmail $model
     */
    protected $model;

    /**
     * BaseAction constructor.
     *
     * @param Request     $request     Request.
     * @param SystemEmail $systemEmail SystemEmail.
     */
    public function __construct(
        Request $request,
        SystemEmail $systemEmail
    ) {
        parent::__construct($request);
        $this->model = $systemEmail;
    }
}
