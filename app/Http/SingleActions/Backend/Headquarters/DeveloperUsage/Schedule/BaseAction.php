<?php

namespace App\Http\SingleActions\Backend\Headquarters\DeveloperUsage\Schedule;

use App\Http\SingleActions\MainAction;
use App\Models\DeveloperUsage\TaskScheduling\CronJob;
use Illuminate\Http\Request;

/**
 * Class BaseAction
 *
 * @package App\Http\SingleActions\Backend\Headquarters\DeveloperUsage\Schedule
 */
class BaseAction extends MainAction
{

    /**
     * @var CronJob $model
     */
    protected $model;

    /**
     * BaseAction constructor.
     *
     * @param Request $request Request.
     * @param CronJob $cronJob CronJob.
     */
    public function __construct(
        Request $request,
        CronJob $cronJob
    ) {
        parent::__construct($request);
        $this->model = $cronJob;
    }
}
