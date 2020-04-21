<?php

/**
 * Created by PhpStorm.
 * author: harris
 * Date: 3/27/19
 * Time: 9:51 AM
 */

namespace App\Services\Logs\MerchantLogs;

use App\Models\DeveloperUsage\Merchant\SystemRoutesMerchant;
use App\Models\Systems\SystemLogsMerchant;
use Jenssegers\Agent\Agent;

/**
 * Class MerchantLogProcessor
 * @package App\Services\Logs\MerchantLogs
 */
class MerchantLogProcessor
{

    /**
     * @param Agent $agent AgentObj.
     * @return integer
     */
    private function _prepareType(Agent $agent): int
    {
        if ($agent->isRobot()) {
            $type = SystemLogsMerchant::ROBOT;
        } elseif ($agent->isDesktop()) {
            $type = SystemLogsMerchant::DESKSTOP;
        } elseif ($agent->isTablet()) {
            $type = SystemLogsMerchant::TABLET;
        } elseif ($agent->isMobile()) {
            $type = SystemLogsMerchant::MOBILE;
        } elseif ($agent->isPhone()) {
            $type = SystemLogsMerchant::PHONE;
        } else {
            $type = SystemLogsMerchant::OTHER;
        }
        return $type;
    }

    /**
     * @param array $record Records.
     * @return mixed[]
     */
    public function __invoke(array $record): array
    {
        $agent           = new Agent();
        $request         = request();
        $clientOs        = $agent->platform();
        $osVersion       = $agent->version($clientOs);
        $browser         = $agent->browser();
        $bsVersion       = $agent->version($browser);
        $robot           = $agent->robot();
        $type            = $this->_prepareType($agent);
        $messageArr      = json_decode($record['message'], true, 512, JSON_THROW_ON_ERROR);
        $auth            = auth($request->get('guard'))->user();
        $record['extra'] = [
                            'admin_id'    => optional($auth)->id,
                            'admin_name'  => optional($auth)->name,
                            'origin'      => $request->headers->get('origin'),
                            'ip'          => $request->ip(),
                            'ips'         => json_encode($request->ips(), JSON_THROW_ON_ERROR, 512),
                            'user_agent'  => $request->server('HTTP_USER_AGENT'),
                            'lang'        => json_encode($agent->languages(), JSON_THROW_ON_ERROR, 512),
                            'device'      => $agent->device(),
                            'os'          => $clientOs,
                            'browser'     => $browser,
                            'bs_version'  => $bsVersion,
                            'device_type' => $type,
                            'log_uuid'    => $messageArr['log_uuid'],
                           ];
        if ($osVersion) {
            $record['extra']['os_version'] = $osVersion;
        }
        if ($robot) {
            $record['extra']['robot'] = $robot;
        }
        if (isset($messageArr['input'])) {
            $record['extra']['inputs'] = $messageArr['input'];
        }
        if (isset($messageArr['route'])) {
            $record['extra']['route'] = $messageArr['route'];
            $routeEloq                = SystemRoutesMerchant::where('route_name', $messageArr['route']['action']['as'])
                ->first();
            if ($routeEloq !== null) {
                $record['extra']['route_id']   = $routeEloq->id;
                $record['extra']['menu_id']    = $routeEloq->menu->id ?? null;
                $record['extra']['menu_label'] = $routeEloq->menu->label ?? null;
                $record['extra']['menu_path']  = $routeEloq->menu->route ?? null;
            }
            $record['message'] = '网络操作信息';
        }
        return $record;
    }
}
