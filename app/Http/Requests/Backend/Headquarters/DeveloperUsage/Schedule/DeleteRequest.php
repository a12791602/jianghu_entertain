<?php

namespace App\Http\Requests\Backend\Headquarters\DeveloperUsage\Schedule;

use App\Http\Requests\BaseFormRequest;
use App\Models\DeveloperUsage\TaskScheduling\CronJob;

/**
 * Class DeleteRequest
 *
 * @package App\Http\Requests\Backend\Headquarters\DeveloperUsage\Schedule
 */
class DeleteRequest extends BaseFormRequest
{
    
    /**
     * @var array 需要依赖模型中的字段备注信息
     */
    protected $dependentModels = [CronJob::class];
    
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return boolean
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return mixed[]
     */
    public function rules(): array
    {
        return ['id' => 'required|exists:cron_jobs,id'];
    }
}
