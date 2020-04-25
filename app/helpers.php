<?php

/**
 * Created by PhpStorm.
 * author: Harris
 * Date: 8/14/2019
 * Time: 5:25 PM
 */

use App\Lib\Crypt\DataCrypt;
use App\Models\Notification\MerchantNotificationStatistic;
use App\Models\Systems\SystemDomain;
use App\Models\Systems\SystemLogsBackend;
use App\Models\Systems\SystemPlatform;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

if (!function_exists('configure')) {
    /**
     * @param  string      $platformSign 平台标识.
     * @param  string|null $sysKey       SysKey.
     * @param  string|null $default      Default.
     * @return \Illuminate\Contracts\Foundation\Application|mixed
     */
    function configure(string $platformSign, ?string $sysKey = null, ?string $default = null)
    {
        $configure = app('App\Lib\Configure');
        if (isset($sysKey)) {
            $configure = $configure->getData($platformSign, $sysKey, $default);
        }
        return $configure;
    }
}

/**
 * @param mixed  $data        Data.
 * @param string $code        Code.
 * @param string $message     Message.
 * @param string $placeholder Placeholder.
 * @param string $substituted Substituted.
 * @return JsonResponse
 * @throws RuntimeException 异常.
 */
function msgOut(
    $data = [],
    string $code = '200',
    string $message = '',
    string $placeholder = '',
    string $substituted = ''
): JsonResponse {
    if ($placeholder === '' || $substituted === '') {
        $message = $message === '' ? __('codes-map.' . $code) : $message;
    } else {
        $message = $message === '' ? __('codes-map.' . $code, [$placeholder => $substituted]) : $message;
    }

    $datas       = [
                    'status'  => true,
                    'code'    => $code,
                    'data'    => $data,
                    'message' => $message,
                   ];
    $handledData = DataCrypt::handle($datas);
    $resource    = $handledData['data'];

    if ($resource instanceof JsonResource) {
        if ($resource->resource instanceof LengthAwarePaginator) {
            $handledData['data'] = $resource->resource;
        }
    }
    return Response::json($handledData);
}

/**
 * Send the verification code.
 * @param string $mobile Mobile.
 * @return mixed[]
 * @throws \Exception Exception.
 */
function sendVerificationCode(string $mobile): array
{
    $random           = strval(random_int(1, 999999));
    $code             = str_pad($random, 6, '0', STR_PAD_LEFT);
    $currentReqTime   = Carbon::now()->timestamp;
    $nextReqTime      = Carbon::now()->addMinutes(1)->timestamp;
    $expiredAt        = now()->addMinutes(10);
    $verification_key = 'verificationCode:' . Str::random(15);

    Cache::put($verification_key, ['mobile' => $mobile, 'verification_code' => $code], $expiredAt);

    $item = [
             'verification_key' => $verification_key,
             'expired_at'       => $expiredAt->toDayDateTimeString(),
             'nextReqTime'      => $nextReqTime, // Next allowed request timestamp.
             'currentReqTime'   => $currentReqTime, // Current request timestamp.
            ];

    if (!app()->environment('production')) {
        $item['verification_code'] = $code;
    }
    return $item;
}

/**
 * 获取当前域名所属平台
 * @param Request $request Request.
 * @return SystemPlatform
 * @throws \Exception Exception.
 */
function getCurrentPlatform(Request $request): SystemPlatform
{
    //获取来源域名
    //$host = $request->server('HTTP_REFERER', 'HTTP_REFERER'); // https://www.learnku.com/laravel
    unset($request);
    $host = 'http://api.397017.com'; // 因yapi插件获取域名问题, 暂时先开白
    if (!is_string($host)) {
        throw new \Exception('100611');
    }
    $strArr = explode('/', $host); // [ 0 => "http:", 1 => "", 2 => "www.learnku.com", 3 => "laravel"]

    if (!is_array($strArr) || !isset($strArr[2])) {
        throw new \Exception('100611');
    }
    $domain     = $strArr[2]; // "www.learnku.com"
    $domainEloq = SystemDomain::where('domain', $domain)->first();
    if (!$domainEloq) {
        throw new \Exception('100609');
    }
    //域名所属平台
    $currentPlatformEloq = $domainEloq->platform;
    if (!$currentPlatformEloq) {
        throw new \Exception('100610');
    }
    $currentSSL = $currentPlatformEloq->sslKey;
    if (!$currentSSL) {
        throw new \Exception('100602');
    }
    return $currentPlatformEloq;
}

if (!function_exists('isJson')) {
    /**
     * 检测给定的字符串是不是json格式.
     *
     * @param string $string 待检测的字符串.
     * @return boolean
     */
    function isJson(string $string): bool
    {
        try {
            $jObject = json_decode($string);
        } catch (\Throwable $exception) {
            return false;
        }
        return is_object($jObject);
    }
}

/**
 * get node Hex for orderid or logid
 * @return string
 */
function getUUidNodeHex(): string
{
    $uuid       = Str::orderedUuid();
    $uuidString = $uuid->toString();
    return Str::afterLast($uuidString, '-');
}

/**
 * 生成编号
 * @return string
 */
function getSerialNumber(): string
{
    $sign    = getCurrentPlatformSign();
    $nodeHex = getUUidNodeHex();
    return $sign . $nodeHex;
}

/**
 * 获取平台Sign
 * @return string
 */
function getCurrentPlatformSign(): string
{
    $request         = request();
    $currentPlatform = $request->get('current_platform_eloq');
    if ($currentPlatform) {
        return $currentPlatform->sign;
    }
    return 'JHHY';
}

/**
 * 获取 referrer domain
 * @return string
 */
function getReferrerDomain(): string
{
    $request  = request();
    $referrer = (string) $request->headers->get('referer');
    return getDomain($referrer);
}

/**
 * 获取 domain
 * @param string $host Host.
 * @return string
 */
function getDomain(string $host): string
{
    return Str::after($host, '://');
}

/**
 * 快捷记录 传输数据 与  头数据
 * @param string      $channel   日志渠道.
 * @param string|null $logMarker 带标注.
 * @throws JsonException Exception.
 * @return void
 */
function logAllRequestInfos(string $channel, ?string $logMarker): void
{
    $request    = request();
    $inputToLog = json_encode($request->all(), JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT, 512);
    Log::channel($channel)->info($logMarker . ' Inputs are ' . $inputToLog);
    $headersToLog = json_encode($request->header(), JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT, 512);
    Log::channel($channel)->info($logMarker . '  Headers are ' . $headersToLog);
}

/**
 * 商户顶部清除通知计数
 * @param string $message_type Message_type.
 * @return void
 * @throws Exception Exception.
 */
function merchantNotificationClear(string $message_type): void
{
    $condition                 = [];
    $condition['platform_id']  = request()->get('current_platform_eloq')->id;
    $condition['message_type'] = $message_type;
    MerchantNotificationStatistic::where($condition)->update(['count' => MerchantNotificationStatistic::COUNT_ZERO]);
}

/**
 * 商户顶部通知计数增加
 * @param string $message_type Message_type.
 * @return void
 * @throws RuntimeException Exception.
 */
function merchantNotificationIncrement(string $message_type): void
{
    $condition                 = [];
    $condition['platform_id']  = request()->get('current_platform_eloq')->id;
    $condition['message_type'] = $message_type;
    MerchantNotificationStatistic::where($condition)->increment('count');
}

/**
 * 后台操作记录
 * @param  array $inputDatas 传递的查询条件.
 * @return mixed[]
 */
function backendOperationLog(array $inputDatas): array
{
    $systemLogsBackend = new SystemLogsBackend();
    if (isset($inputDatas['pageSize'])) {
        $systemLogsBackend->setPerPage($inputDatas['pageSize']);
    }
    $result = $systemLogsBackend->filter($inputDatas)
        ->select(
            [
             'origin',
             'ip',
             'user_agent',
             'inputs',
             'route_id',
             'admin_name',
             'created_at',
             'route',
            ],
        )
        ->with('route:id,title')
        ->paginate()
        ->toArray();

    $data = [];
    foreach ($result['data'] as $time) {
        $data[] = [
                   'title'      => $time['route']['title'] ?? '',
                   'admin_name' => $time['admin_name'],
                   'created_at' => $time['created_at'],
                   'origin'     => $time['origin'],
                   'ip'         => $time['ip'],
                   'user_agent' => $time['user_agent'],
                  ];
    }

    $result['data'] = $data;
    return $result;
}

/**
 * 获取模型对应的filter
 * @param  mixed $model 模型.
 * @return string
 * @throws \Exception Exception.
 */
function getFilter($model): string
{
    $modelPath = get_class($model);
    $needle    = 'Models';
    $filter    = substr_replace($modelPath, 'ModelFilters', strpos($modelPath, $needle), strlen($needle)) . 'Filter';
    if (!class_exists($filter)) {
        throw new \Exception('302600');
    }
    return $model->provideFilter($filter);
}
