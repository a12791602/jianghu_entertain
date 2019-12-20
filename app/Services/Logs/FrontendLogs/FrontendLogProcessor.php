<?php

/**
 * Created by PhpStorm.
 * author: harris
 * Date: 3/27/19
 * Time: 9:51 AM
 */

namespace App\Services\Logs\FrontendLogs;

use App\Models\Systems\FrontendSystemLog;
use Jenssegers\Agent\Agent;

/**
 * Class FrontendLogProcessor
 * @package App\Services\Logs\FrontendLogs
 */
class FrontendLogProcessor
{

    /**
     * @param array $record Records.
     * @return mixed[]
     */
    public function __invoke(array $record): array
    {
        $agent           = new Agent();
        $clientOs        = $agent->platform();
        $osVersion       = $agent->version($clientOs);
        $browser         = $agent->browser();
        $bsVersion       = $agent->version($browser);
        $robot           = $agent->robot();
        $type            = $this->_prepareType($agent);
        $messageArr      = json_decode($record['message'], true, 512, JSON_THROW_ON_ERROR);
        $userId          = auth()->user() ? auth()->user()->id : null;
        $record['extra'] = [
            'user_id' => $userId,
            'username' => $userId !== null ? auth()->user()->username : null,
            'origin' => request()->headers->get('origin'),
            'ip' => request()->ip(),
            'ips' => json_encode(request()->ips(), JSON_THROW_ON_ERROR, 512),
            'user_agent' => request()->server('HTTP_USER_AGENT'),
            'lang' => json_encode($agent->languages(), JSON_THROW_ON_ERROR, 512),
            'device' => $agent->device(),
            'os' => $clientOs,
            'browser' => $browser,
            'bs_version' => $bsVersion,
            'device_type' => $type,
            'log_uuid' => $messageArr['log_uuid'],
        ];
        if ($osVersion) {
            $record['extra']['os_version'] = $osVersion;
        }
        if ($robot) {
            $record['extra']['robot'] = $robot;
        }
        if (isset($messageArr['input'])) {
            $record['extra']['inputs'] = json_encode($messageArr['input'], JSON_THROW_ON_ERROR, 512);
        }
        /*if (isset($messageArr['route'])) {
        $record['extra']['route'] = json_encode($messageArr['route']);
        $routeEloq = BackendAdminRoute::where('route_name', $messageArr['route']['action']['as'])->first();
        if ($routeEloq !== null) {
        $record['extra']['route_id'] = $routeEloq->id;
        $record['extra']['menu_id'] = $routeEloq->menu->id ?? null;
        $record['extra']['menu_label'] = $routeEloq->menu->label ?? null;
        $record['extra']['menu_path'] = $routeEloq->menu->route ?? null;
        }
        $record['message'] = '网络操作信息';
        }*/
        return $record;
    }

    /**
     * @param Agent $agent AgentObj.
     * @return integer
     */
    private function _prepareType(Agent $agent): int
    {
        if ($agent->isRobot()) {
            $type = FrontendSystemLog::ROBOT;
        } elseif ($agent->isDesktop()) {
            $type = FrontendSystemLog::DESKSTOP;
        } elseif ($agent->isTablet()) {
            $type = FrontendSystemLog::TABLET;
        } elseif ($agent->isMobile()) {
            $type = FrontendSystemLog::MOBILE;
        } elseif ($agent->isPhone()) {
            $type = FrontendSystemLog::PHONE;
        } else {
            $type = FrontendSystemLog::OTHER;
        }
        return $type;
    }
}
