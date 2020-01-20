<?php

/**
 * Created by PhpStorm.
 * author: harris
 * Date: 3/27/19
 * Time: 10:41 AM
 */

namespace App\Listeners;

use App\Models\Systems\SystemLogsBackend;
use App\Services\Logs\BackendLogs\BackendLogMonologEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

/**
 * Class BackendLogMonologEventListener
 * @package App\Listeners
 */
class BackendLogMonologEventListener implements ShouldQueue
{

    /**
     * @var string
     */
    public $queue = 'apilogs';

    /**
     * @var SystemLogsBackend
     */
    protected $sysLog;

    /**
     * @var integer data to delete.
     */
    protected $recordedDays;

    /**
     * BackendLogMonologEventListener constructor.
     * @param SystemLogsBackend $sysLog BackendSystemLog.
     */
    public function __construct(SystemLogsBackend $sysLog)
    {
        $this->sysLog = $sysLog;
    }

    /**
     * @param BackendLogMonologEvent $event EventObj.
     * @return void
     */
    public function onLog(BackendLogMonologEvent $event): void
    {
        $sysLog             = new $this->sysLog();
        $this->recordedDays = config('logsetting.day');
        //7天以上的数据都删掉
        $date    = Carbon::now()->subDays($this->recordedDays)->format('Y-m-d H:i:s');
        $logEloq = $sysLog->where('created_at', '<', $date)->get();
        if (!$logEloq->isEmpty()) {
            foreach ($logEloq as $items) {
                $items->delete();
            }
        }
        //记录日志
        $sysLog->fill($event->records['formatted']);
        $sysLog->save();
    }

    /**
     * @param Dispatcher $events Register the listeners for the subscriber.
     * @return void
     */
    public function subscribe(Dispatcher $events): void
    {
        try {
            $events->listen(
                BackendLogMonologEvent::class,
                'App\Listeners\BackendLogMonologEventListener@onLog',
            );
        } catch (\Throwable $e) {
            Log::channel('daily')->error(
                $e->getMessage(),
                ['exception' => $e],
            );
        }
    }
}
