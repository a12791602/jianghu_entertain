<?php

/**
 * Created by PhpStorm.
 * author: harris
 * Date: 3/27/19
 * Time: 9:51 AM
 */

namespace App\Services\Logs\FrontendLogs;

use App\Models\Systems\SystemDomain;
use App\Models\Systems\SystemLogsFrontend;
use App\Models\User\FrontendUser;
use Jenssegers\Agent\Agent;

/**
 * Class FrontendLogProcessor
 * @package App\Services\Logs\FrontendLogs
 */
class FrontendLogProcessor
{

    /**
     * @param Agent $agent AgentObj.
     * @return integer
     */
    private function _prepareType(Agent $agent): int
    {
        if ($agent->isRobot()) {
            $type = SystemLogsFrontend::ROBOT;
        } elseif ($agent->isDesktop()) {
            $type = SystemLogsFrontend::DESKSTOP;
        } elseif ($agent->isTablet()) {
            $type = SystemLogsFrontend::TABLET;
        } elseif ($agent->isMobile()) {
            $type = SystemLogsFrontend::MOBILE;
        } elseif ($agent->isPhone()) {
            $type = SystemLogsFrontend::PHONE;
        } else {
            $type = SystemLogsFrontend::OTHER;
        }
        return $type;
    }

    /**
     * Get user's information.
     * @param object $auth          Auth.
     * @param string $platform_sign Platform_sign.
     * @param string $route_name    Route_name.
     * @param array  $messageArr    MessageArr.
     * @return mixed[]
     */
    public function information(
        object $auth,
        string $platform_sign = '',
        string $route_name = '',
        array $messageArr = []
    ): array {
        $item = [];
        if ($auth->check()) {
            $item['user_id'] = auth()->user()->id;
            $item['mobile']  = auth()->user()->mobile;
        } elseif ($route_name === 'login') {
            $item['mobile']             = $messageArr['input']['mobile'];
            $condition                  = [];
            $condition['mobile']        = $item['mobile'];
            $condition['platform_sign'] = $platform_sign;
            $item['user_id']            = FrontendUser::where($condition)->first(['id'])->id;
        } else {
            $item['user_id'] = null;
            $item['mobile']  = null;
        }
        return $item;
    }

    /**
     * @param array $record Records.
     * @return mixed[]
     * @throws \Exception Exception.
     */
    public function __invoke(array $record): array
    {
        $agent         = new Agent();
        $baseUrl       = explode('/', request()->root());
        $domain        = array_pop($baseUrl);
        $system_domain = SystemDomain::where('domain', $domain)->first(['platform_sign']);
        if (!$system_domain) {
            throw new \Exception('100609');
        }
        $platform_sign   = $system_domain->platform_sign;
        $clientOs        = $agent->platform();
        $osVersion       = $agent->version($clientOs);
        $browser         = $agent->browser();
        $bsVersion       = $agent->version($browser);
        $robot           = $agent->robot();
        $type            = $this->_prepareType($agent);
        $messageArr      = json_decode($record['message'], true, 512, JSON_THROW_ON_ERROR);
        $route_path      = explode('/', request()->path());
        $route_name      = array_pop($route_path);
        $user_info       = $this->information(auth(), $platform_sign, $route_name, $messageArr);
        $record['extra'] = [
                            'user_id'       => $user_info['user_id'],
                            'mobile'        => $user_info['mobile'],
                            'platform_sign' => $platform_sign,
                            'origin'        => request()->headers->get('origin'),
                            'ip'            => request()->ip(),
                            'ips'           => json_encode(request()->ips(), JSON_THROW_ON_ERROR, 512),
                            'user_agent'    => request()->server('HTTP_USER_AGENT'),
                            'lang'          => json_encode($agent->languages(), JSON_THROW_ON_ERROR, 512),
                            'device'        => $agent->device(),
                            'os'            => $clientOs,
                            'browser'       => $browser,
                            'bs_version'    => $bsVersion,
                            'device_type'   => $type,
                            'log_uuid'      => $messageArr['log_uuid'],
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
        return $record;
    }
}
