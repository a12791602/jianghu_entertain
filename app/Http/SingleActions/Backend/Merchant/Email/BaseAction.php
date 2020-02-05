<?php

namespace App\Http\SingleActions\Backend\Merchant\Email;

use App\Http\SingleActions\MainAction;
use App\Models\Email\SystemEmail;
use Illuminate\Http\Request;

/**
 * Class SendAction
 * @package App\Http\SingleActions\Backend\Merchant\Email
 */
class BaseAction extends MainAction
{

    /**
     * @var SystemEmail $model
     */
    protected $model;

     /**
      * MainAction constructor.
      * @param SystemEmail $systemEmail 邮件.
      * @param Request     $request     Request.
      * @throws \Exception Exception.
      */
    public function __construct(SystemEmail $systemEmail, Request $request)
    {
        parent::__construct($request);
        $this->model = $systemEmail;
    }
}
