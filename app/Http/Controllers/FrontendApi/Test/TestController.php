<?php

namespace App\Http\Controllers\FrontendApi\Test;

use App\Http\Requests\Frontend\Common\RegisterRequest;
use App\Http\SingleActions\Frontend\Common\FrontendAuth\RegisterAction;
use App\Http\SingleActions\MainAction;
use App\Models\User\FrontendUser;
use Cache;
use Faker\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class TestController
 * @package App\Http\Controllers\FrontendApi\Test
 */
class TestController extends MainAction
{
    /**
     * 测试帐变接口
     * @param Request $request Request.
     * @return mixed
     * @throws \Exception Exception.
     */
    public function accountChange(Request $request)
    {
        $inputDatas = $request->all();
        $user       = $this->user;
        if (!$user) {
            return;
        }
        $account = $user->account;
        if (!$account) {
            return;
        }
        $inputDatas['params'] = json_decode($inputDatas['params'], true);
        if (!$inputDatas['params']) {
            $inputDatas['params'] = [];
        }
        $data   = $account->operateAccount($inputDatas, $inputDatas['type'], $inputDatas['params']);
        $msgOut = msgOut($data);
        return $msgOut;
    }

    /**
     * Generate users.
     * @param RegisterAction $action RegisterAction.
     * @return mixed
     * @throws \Exception Exception.
     */
    public function userGenerate(RegisterAction $action)
    {
        $request             = new RegisterRequest();
        $request['password'] = '12345Eth';
        $mobile              = 18844440000;
        $already_user        = FrontendUser::where('mobile', $mobile)->exists();
        if ($already_user) {
            return;
        }
        for ($i = 0; $i < 600; $i++) {
            $verification_key             = 'verificationCode:generate_user_' . $i;
            $mobile                      += $i;
            $request['mobile']            = $mobile;
            $request['verification_key']  = $verification_key;
            $request['verification_code'] = strval($mobile);
            Cache::put($verification_key, ['mobile' => $mobile, 'verification_code' => strval($mobile)]);
            $action->execute($request);
        }
        $result = msgOut();
        return $result;
    }

    /**
     * Generate user information.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function balanceGenerate(): JsonResponse
    {
        $faker = Factory::create('zh_CN');
        FrontendUser::all()->map(
            static function ($item) use ($faker): void {
                $balance                = 1000000000;
                $item->account->balance = $balance - $item->id;
                $item->account->save();
                $item->specificInfo->nickname = $faker->firstNameFemale . $faker->titleFemale;
                $item->specificInfo->save();
            },
        );
        $result = msgOut();
        return $result;
    }
}
