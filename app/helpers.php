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
use App\Models\Systems\SystemPlatform;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
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
 * Setting Data into the Config
 *
 * @param string $filename FileName.
 * @param array  $params   Params.
 * @var string $params [use_type] int 1 common , 2 individual
 * @var int $params [type] int, required 1 是普通数据的结果要存入为json 2 是表的结果要存入为 json  type 1 时不需要 table_name type 2 时需要 table_name
 * @var string $params [title] string, required           use_type 1|2  type 1|2 英文字母大小写.
 * @var string $params [description] string, required     use_type 1|2  type 1|2 中文备注.
 * @var string $params [table] string, required           use_type 1|2  type 2   表名存入.
 * @var string $params [fields] string, required          use_type 1|2  type 2   表名中要存入 json 的字段 比如 id,name,code,status
 * @var string $params [platform_sign] string, required   use_type 2.
 * @var string $params [path] string, required            use_type 1|2  type 1|2 存文件路径.
 * @var string $params [data] array, required             use_type 1|2  type 1 时 传入的数据 最终需要转变为 json.
 * @return boolean
 * @throws Exception Exception.
 */
function genStaticJSON(string $filename, array $params): bool
{
    $staticJson = app('App\Lib\StaticJson\StaticJsonHandler');
    return $staticJson->setData($filename, $params);
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

    $item = [
             'status'  => true,
             'code'    => $code,
             'data'    => $data,
             'message' => $message,
            ];
    if ($data instanceof JsonResource) {
        if ($data->resource instanceof LengthAwarePaginator) {
            $item['data'] = $data->resource;
        }
    }
    $handledData = DataCrypt::handle($item);
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
    saveLog($channel, $logMarker . ' Inputs are ' . $inputToLog);
    $headersToLog = json_encode($request->header(), JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT, 512);
    saveLog($channel, $logMarker . '  Headers are ' . $headersToLog);
}

/**
 * 快捷记录日志
 * @param  string $channel 日志渠道.
 * @param  mixed  $info    日志内容.
 * @return void
 */
function saveLog(string $channel, $info): void
{
    Log::channel($channel)->info($info);
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
 * @param  object $systemLog  日志表Eloq.
 * @param  array  $inputDatas 传递的查询条件.
 * @return mixed[]
 */
function backendOperationLog(object $systemLog, array $inputDatas): array
{
    if (isset($inputDatas['pageSize'])) {
        $systemLog->setPerPage($inputDatas['pageSize']);
    }
    $result = $systemLog->filter($inputDatas)
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
        ->orderBy('created_at', 'desc')
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
                   'inputs'     => $time['inputs'],
                  ];
    }

    $result['data'] = $data;
    return $result;
}

/**
 * @param object $result         Eloquent Object.
 * @param array  $toRetrieveData Mixed Field Data.
 * @param array  $field          Data Field to Retrieve like ['type', 'path', 'description', 'title'].
 * @return object
 */
function prepareBeforeSave(object $result, array $toRetrieveData, array $field): object
{
    $eloqToSaveData = Arr::only($toRetrieveData, $field);
    foreach ($eloqToSaveData as $updKey => $updValue) {
        $result->$updKey = $updValue;
    }
    return $result;
}

/**
 * 保存游戏日志
 * @param  string $info              日志信息.
 * @param  string $theirSerialNumber 三方订单号.
 * @return void
 */
function saveGameLog(string $info, string $theirSerialNumber = ''): void
{
    if ($theirSerialNumber === '') {
        saveLog('game', $info);
    } else {
        saveLog('game', $info . '，their_serial_number：' . $theirSerialNumber);
    }
}

/**
 * @param array        $data    Product of Arr Data.
 * @param integer|null $perPage Define how many data we want to be visible in each page.
 * @return LengthAwarePaginator
 */
function paginateArray(array $data, ?int $perPage = 1): LengthAwarePaginator
{
    // Get current page form url e.x. &page=1
    $currentPage = LengthAwarePaginator::resolveCurrentPage();

    // Create a new Laravel collection from the array data
    $productCollection = collect($data);
    // Slice the collection to get the data to display in current page
    $currentPageproducts = $productCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
    // Create our paginator and pass it to the view
    $paginatedproducts = new LengthAwarePaginator($currentPageproducts, count($productCollection), (int) $perPage);

    // set url path for generted links
    $paginatedproducts->setPath(request()->url());
    return $paginatedproducts;
}

/**
 * 获取json 或 图片地址
 *
 * @param string $path FilePath.
 * @param string $type Type json|pic.
 * @return mixed
 */
function getJHHYUrl(string $path, string $type)
{
    return Storage::disk($type)->url($path);
}

/**
 * 转换浮点
 * @param  string       $field     需要转换的字段.
 * @param integer|null $precision 要转换的浮点.
 * @return string
 */
function floatDC(string $field, ?int $precision = 2): string
{
     return sprintf('%.' . $precision . 'f', $field);
}
