<?php

/**
 * Created by PhpStorm.
 * author: harris
 * Date: 3/27/19
 * Time: 10:41 AM
 */

namespace App\Listeners;

use App\Models\Systems\SystemLogsFrontend;
use App\Models\Systems\SystemPlatform;
use App\Models\User\FrontendUser;
use App\Models\User\UsersLoginLog;
use App\Services\Logs\FrontendLogs\FrontendLogMonologEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

/**
 * Class FrontendLogMonologEventListener
 * @package App\Listeners
 */
class FrontendLogMonologEventListener implements ShouldQueue
{

    /**
     * @var string
     */
    public $queue = 'logs';

    /**
     * @var SystemLogsFrontend
     */
    protected $systemLog;

    /**
     * @var integer data to delete.
     */
    protected $recordedDays;

    /**
     * FrontendLogMonologEventListener constructor.
     * @param SystemLogsFrontend $systemLog FrontendSystemLog.
     */
    public function __construct(SystemLogsFrontend $systemLog)
    {
        $this->systemLog = $systemLog;
    }

    /**
     * @param FrontendLogMonologEvent $event EventObj.
     * @return void
     */
    public function onLog(FrontendLogMonologEvent $event): void
    {
        $sysLog             = new $this->systemLog();
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
        $this->saveToUserLogTable($event->records['formatted']);
    }

    /**
     * Save to Login Logs
     * @param array $data Data.
     * @return void
     */
    protected function saveToUserLogTable(array $data): void
    {
        $systemPlatform                  = SystemPlatform::where('sign', $data['platform_sign'])->first();
        $toSaveData                      = Arr::only($data, ['platform_sign', 'mobile', 'origin']);
        $toSaveData['last_login_ip']     = $data['ip'];
        $toSaveData['pid']               = $systemPlatform->id ?? 0;
        $toSaveData['last_login_device'] = $data['device_type'];
        $frontUser                       = FrontendUser::where('mobile', $data['mobile'])->first();
        if ($frontUser instanceof FrontendUser) {
            $toSaveData['guid'] = $frontUser->guid;
        }
        $userLog = new UsersLoginLog();
        $userLog->fill($toSaveData);
        $userLog->save();
    }

    /**
     * @param Dispatcher $events Register the listeners for the subscriber.
     * @return void
     */
    public function subscribe(Dispatcher $events): void
    {
        try {
            $events->listen(
                FrontendLogMonologEvent::class,
                'App\Listeners\FrontendLogMonologEventListener@onLog',
            );
        } catch (\Throwable $e) {
            Log::channel('daily')->error(
                $e->getMessage(),
                ['exception' => $e],
            );
        }
    }
}
