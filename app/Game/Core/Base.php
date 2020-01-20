<?php

namespace App\Game\Core;

use App\Models\Game\Game as GameModel;
use App\Models\User\FrontendUser;

/**
 * Class Base
 * @package App\Game\Core
 */
abstract class Base implements Game
{
    use CommonUnit;

    public const MODE_JUMP = 'jump'; //前端拿到游戏内容直接跳转
    public const MODE_HTML = 'html'; //前端拿到游戏内容开一个新页面

    /**
     * 用户信息.
     *
     * @var mixed[] $userInfo
     */
    public $userInfo = [
                        'isTester' => 0, //是否是测试 或者 游客
                        'uid'      => null, //用户uid
                        'platform' => null, //用户所属平台
                       ];

    /**
     * 游戏信息.
     *
     * @var mixed[] $gameInfo
     */
    public $gameInfo = [
                        'gameName'           => null,
                        'gameSign'           => null,
                        'converUrl'          => null, //上分下分地址
                        'checkBalanceUrl'    => null, //检查用户第三方余额地址
                        'checkOrderUrl'      => null, //检查用户上下分订单地址
                        'inGameUrl'          => null, //进入游戏地址
                        'getStationOrderUrl' => null, //获取用户第三方注单地址
                        'appId'              => null, //终端号
                        'authorizationCode'  => null, //授权码
                        'merchantCode'       => null, //商户号
                        'merchantSecret'     => null, //商户密钥
                        'publicKey'          => null, //公钥
                        'privateKey'         => null, //私钥
                       ];

    /**
     * 返回的数据.
     *
     * @var mixed[] $returnData
     */
    public $returnData = [
                          'gameContent' => null, //游戏内容
                          'mode'        => null, //请求方式
                         ];

    /**
     * 游戏列表.
     *
     * @var mixed[] $gameList
     */
    public $gameList = [
                        'name' => null,
                        'ico'  => null,
                        'link' => null,
                       ];

    /**
     * 设置哪个用户进入哪个游戏.
     *
     * @param GameModel    $game 游戏.
     * @param FrontendUser $user 用户.
     * @return Game
     */
    public function setPreDataOfGame(GameModel $game, FrontendUser $user): Game
    {
        $this->userInfo['uid']      = $user->uid;
        $this->userInfo['platform'] = $user->platform_sign;
        $this->userInfo['isTester'] = $user->is_tester;
        $this->gameInfo['gameName'] = $game->name;
        $this->gameInfo['gameSign'] = $game->sign;
        //如果不是测试或者试玩 则用正式地址和商户
        if ((int) $user['isTester'] === FrontendUser::IS_TESTER_NO) {
            $this->gameInfo['converUrl']          = $game->conver_url;
            $this->gameInfo['checkBalanceUrl']    = $game->check_balance_url;
            $this->gameInfo['checkOrderUrl']      = $game->check_order_url;
            $this->gameInfo['inGameUrl']          = $game->in_game_url;
            $this->gameInfo['getStationOrderUrl'] = $game->get_station_order_url;
            $this->gameInfo['appId']              = $game->app_id;
            $this->gameInfo['authorizationCode']  = $game->authorization_code;
            $this->gameInfo['merchantCode']       = $game->merchant_code;
            $this->gameInfo['merchantSecret']     = $game->merchant_secret;
            $this->gameInfo['publicKey']          = $game->public_key;
            $this->gameInfo['privateKey']         = $game->private_key;
        } elseif ((int) $user['isTester'] === FrontendUser::IS_TESTER_YES) {
            $this->gameInfo['converUrl']          = $game->test_conver_url;
            $this->gameInfo['checkBalanceUrl']    = $game->test_check_balance_url;
            $this->gameInfo['checkOrderUrl']      = $game->test_check_order_url;
            $this->gameInfo['inGameUrl']          = $game->test_in_game_url;
            $this->gameInfo['getStationOrderUrl'] = $game->test_get_station_order_url;
        }
        return $this;
    }
}
