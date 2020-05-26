<?php

namespace App\Http\SingleActions\Frontend\Common\FrontendAuth;

use App\Http\Requests\Frontend\Common\RegisterRequest;
use App\Http\SingleActions\MainAction;
use App\Lib\Constant\JHHYCnst;
use App\Models\User\FrontendUser;
use Cache;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
use Tymon\JWTAuth\Facades\JWTAuth;

/**
 * Class RegisterAction
 * @package App\Http\SingleActions\Common\FrontendAuth
 */
class RegisterAction extends MainAction
{
    
    /**
     * Frontend registration action.
     * @param RegisterRequest $request Frontend RegisterRequest.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(RegisterRequest $request): JsonResponse
    {
        $guard       = $this->guard;
        $platform    = $this->agent->platform();
        $device_code = JHHYCnst::DEVICE_H5;
        if ($guard === JHHYCnst::GUARD_H5) {
            $device_code = JHHYCnst::DEVICE_H5;
        } elseif ($guard === JHHYCnst::GUARD_APP) {
            if ($platform === 'AndroidOS') {
                $device_code = JHHYCnst::DEVICE_APK;
            } else {
                $device_code = JHHYCnst::DEVICE_APP;
            }
        }
        $platform_sign    = $this->currentPlatformEloq->sign;
        $redis            = Redis::connection();
        $register_user_id = $redis->spop($platform_sign . '_' . config('web.main.frontend_user_unique_id'))[0];
        $verification_key = $request['verification_key'];
        $verifyData       = Cache::get($verification_key);
        if (!$verifyData) {
            throw new \Exception('100502');
        }
        if (!hash_equals($verifyData['verification_code'], $request['verification_code'])) {
            throw new \Exception('100503', 401);
        }
        $invite_code = null;
        if (is_string($request['invite_code'])) {
            $invite_code = $request['invite_code'];
        }
        $user   = $this->user(
            $verifyData['mobile'],
            $register_user_id,
            bcrypt($request['password']),
            (int) $device_code,
            (int) $invite_code,
            $request->ip(),
            $this->currentPlatformEloq->id,
            $platform_sign,
        );
        $data   = $this->token($user, $request);
        $result = msgOut($data);
        Cache::forget($verification_key);
        return $result;
    }

    /**
     * Generate token.
     * @param FrontendUser    $user    Frontend User Model.
     * @param RegisterRequest $request Frontend RegisterRequest.
     * @return mixed[]
     */
    public function token(FrontendUser $user, RegisterRequest $request): array
    {
        $token          = $this->auth->login($user);
        $expireInMinute = $this->auth->factory()->getTTL();
        $expireAt       = Carbon::now()->addMinutes($expireInMinute)->format('Y-m-d H:i:s');
        $user           = $this->auth->user();

        if ($user->remember_token !== null) {
            try {
                JWTAuth::setToken($user->remember_token);
                JWTAuth::invalidate();
            } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
                Log::info($e->getMessage());
            }
        }
        $user->remember_token  = $token;
        $user->last_login_ip   = $request->ip();
        $user->last_login_time = Carbon::now()->timestamp;
        $user->save();
        return [
                'access_token' => $token,
                'token_type'   => 'Bearer',
                'expires_at'   => $expireAt,
               ];
    }

    /**
     * Frontend User Model
     * @param string  $mobile      Mobile.
     * @param string  $guid        Game_user_id.
     * @param string  $password    Password.
     * @param integer $device_code Device_code.
     * @param integer $invite_code Invite_code.
     * @param string  $register_ip Register_ip.
     * @param integer $platform_id Platform_id.
     * @param string  $sign        Sign.
     * @return FrontendUser
     */
    public function user(
        string $mobile,
        string $guid,
        string $password,
        int $device_code,
        int $invite_code,
        ?string $register_ip,
        int $platform_id,
        string $sign
    ): FrontendUser {
        $item = [
                 'mobile'        => $mobile,
                 'guid'          => $guid,
                 'password'      => $password,
                 'device_code'   => $device_code,
                 'invite_code'   => $invite_code,
                 'register_ip'   => $register_ip,
                 'platform_id'   => $platform_id,
                 'platform_sign' => $sign,
                 'type'          => FrontendUser::TYPE_USER,
                ];
        return FrontendUser::create($item);
    }
}
