<?php

use App\Models\Game\GameRoom;
use Illuminate\Database\Seeder;

/**
 * Class GameRoomSeeder
 */
class GameRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        GameRoom::insert(
            [
             [
              'game_series_id' => 2,
              'room_id'        => 3600,
              'room_name'      => '德州扑克新手房',
             ],
             [
              'game_series_id' => 2,
              'room_id'        => 3601,
              'room_name'      => '德州扑克初级房',
             ],
             [
              'game_series_id' => 2,
              'room_id'        => 3602,
              'room_name'      => '德州扑克中级房',
             ],
             [
              'game_series_id' => 2,
              'room_id'        => 3603,
              'room_name'      => '德州扑克高级房',
             ],
             [
              'game_series_id' => 2,
              'room_id'        => 3700,
              'room_name'      => '德州扑克财大气粗房',
             ],
             [
              'game_series_id' => 2,
              'room_id'        => 3701,
              'room_name'      => '德州扑克腰缠万贯房',
             ],
             [
              'game_series_id' => 2,
              'room_id'        => 3702,
              'room_name'      => '德州扑克挥金如土房',
             ],
             [
              'game_series_id' => 2,
              'room_id'        => 3703,
              'room_name'      => '德州扑克富贵逼人房',
             ],
             [
              'game_series_id' => 3,
              'room_id'        => 7201,
              'room_name'      => '二八杠体验房',
             ],
             [
              'game_series_id' => 3,
              'room_id'        => 7202,
              'room_name'      => '二八杠初级房',
             ],
             [
              'game_series_id' => 3,
              'room_id'        => 7203,
              'room_name'      => '二八杠中级房',
             ],
             [
              'game_series_id' => 3,
              'room_id'        => 7204,
              'room_name'      => '二八杠高级房',
             ],
             [
              'game_series_id' => 3,
              'room_id'        => 7205,
              'room_name'      => '二八杠至尊房',
             ],
             [
              'game_series_id' => 3,
              'room_id'        => 7206,
              'room_name'      => '二八杠王者房',
             ],
             [
              'game_series_id' => 4,
              'room_id'        => 8301,
              'room_name'      => '抢庄牛牛体验房',
             ],
             [
              'game_series_id' => 4,
              'room_id'        => 8302,
              'room_name'      => '抢庄牛牛初级房',
             ],
             [
              'game_series_id' => 4,
              'room_id'        => 8303,
              'room_name'      => '抢庄牛牛中级房',
             ],
             [
              'game_series_id' => 4,
              'room_id'        => 8304,
              'room_name'      => '抢庄牛牛高级房',
             ],
             [
              'game_series_id' => 4,
              'room_id'        => 8305,
              'room_name'      => '抢庄牛牛至尊房',
             ],
             [
              'game_series_id' => 4,
              'room_id'        => 8306,
              'room_name'      => '抢庄牛牛王者房',
             ],
             [
              'game_series_id' => 5,
              'room_id'        => 2201,
              'room_name'      => '炸金花体验房',
             ],
             [
              'game_series_id' => 5,
              'room_id'        => 2202,
              'room_name'      => '炸金花初级房',
             ],
             [
              'game_series_id' => 5,
              'room_id'        => 2203,
              'room_name'      => '炸金花中级房',
             ],
             [
              'game_series_id' => 5,
              'room_id'        => 2204,
              'room_name'      => '炸金花高级房',
             ],
             [
              'game_series_id' => 6,
              'room_id'        => 8601,
              'room_name'      => '三公体验房',
             ],
             [
              'game_series_id' => 6,
              'room_id'        => 8602,
              'room_name'      => '三公初级房',
             ],
             [
              'game_series_id' => 6,
              'room_id'        => 8603,
              'room_name'      => '三公中级房',
             ],
             [
              'game_series_id' => 6,
              'room_id'        => 8604,
              'room_name'      => '三公高级房',
             ],
             [
              'game_series_id' => 6,
              'room_id'        => 8605,
              'room_name'      => '三公至尊房',
             ],
             [
              'game_series_id' => 6,
              'room_id'        => 8606,
              'room_name'      => '三公王者房',
             ],
             [
              'game_series_id' => 7,
              'room_id'        => 9001,
              'room_name'      => '龙虎体验房',
             ],
             [
              'game_series_id' => 7,
              'room_id'        => 9002,
              'room_name'      => '龙虎初级房',
             ],
             [
              'game_series_id' => 7,
              'room_id'        => 9003,
              'room_name'      => '龙虎中级房',
             ],
             [
              'game_series_id' => 7,
              'room_id'        => 9004,
              'room_name'      => '龙虎高级房',
             ],
             [
              'game_series_id' => 8,
              'room_id'        => 6001,
              'room_name'      => '21点体验房',
             ],
             [
              'game_series_id' => 8,
              'room_id'        => 6002,
              'room_name'      => '21点初级房',
             ],
             [
              'game_series_id' => 8,
              'room_id'        => 6003,
              'room_name'      => '21点中级房',
             ],
             [
              'game_series_id' => 8,
              'room_id'        => 6004,
              'room_name'      => '21点高级房',
             ],
             [
              'game_series_id' => 9,
              'room_id'        => 8701,
              'room_name'      => '通比牛牛体验房',
             ],
             [
              'game_series_id' => 9,
              'room_id'        => 8702,
              'room_name'      => '通比牛牛初级房',
             ],
             [
              'game_series_id' => 9,
              'room_id'        => 8703,
              'room_name'      => '通比牛牛中级房',
             ],
             [
              'game_series_id' => 9,
              'room_id'        => 8704,
              'room_name'      => '通比牛牛高级房',
             ],
             [
              'game_series_id' => 9,
              'room_id'        => 8705,
              'room_name'      => '通比牛牛至尊房',
             ],
             [
              'game_series_id' => 9,
              'room_id'        => 8706,
              'room_name'      => '通比牛牛王者房',
             ],
             [
              'game_series_id' => 10,
              'room_id'        => 8801,
              'room_name'      => '欢乐红包体验房',
             ],
             [
              'game_series_id' => 10,
              'room_id'        => 8802,
              'room_name'      => '欢乐红包初级房',
             ],
             [
              'game_series_id' => 10,
              'room_id'        => 8803,
              'room_name'      => '欢乐红包中级房',
             ],
             [
              'game_series_id' => 10,
              'room_id'        => 8804,
              'room_name'      => '欢乐红包高级房',
             ],
             [
              'game_series_id' => 11,
              'room_id'        => 2301,
              'room_name'      => '急速炸金花新手房',
             ],
             [
              'game_series_id' => 11,
              'room_id'        => 2302,
              'room_name'      => '急速炸金花初级房',
             ],
             [
              'game_series_id' => 11,
              'room_id'        => 2303,
              'room_name'      => '急速炸金花中级房',
             ],
             [
              'game_series_id' => 11,
              'room_id'        => 2304,
              'room_name'      => '急速炸金花高级房',
             ],
             [
              'game_series_id' => 12,
              'room_id'        => 7301,
              'room_name'      => '抢庄牌九新手房',
             ],
             [
              'game_series_id' => 12,
              'room_id'        => 7302,
              'room_name'      => '抢庄牌九初级房',
             ],
             [
              'game_series_id' => 12,
              'room_id'        => 7303,
              'room_name'      => '抢庄牌九中级房',
             ],
             [
              'game_series_id' => 12,
              'room_id'        => 7304,
              'room_name'      => '抢庄牌九高级房',
             ],
             [
              'game_series_id' => 12,
              'room_id'        => 7305,
              'room_name'      => '抢庄牌九至尊房',
             ],
             [
              'game_series_id' => 12,
              'room_id'        => 7306,
              'room_name'      => '抢庄牌九王者房',
             ],
             [
              'game_series_id' => 15,
              'room_id'        => 6101,
              'room_name'      => '斗地主体验房',
             ],
             [
              'game_series_id' => 15,
              'room_id'        => 6102,
              'room_name'      => '斗地主初级房',
             ],
             [
              'game_series_id' => 15,
              'room_id'        => 6103,
              'room_name'      => '斗地主中级房',
             ],
             [
              'game_series_id' => 15,
              'room_id'        => 6104,
              'room_name'      => '斗地主高级房',
             ],
             [
              'game_series_id' => 13,
              'room_id'        => 6301,
              'room_name'      => '十三水常规场新手房',
             ],
             [
              'game_series_id' => 13,
              'room_id'        => 6302,
              'room_name'      => '十三水常规场初级房房',
             ],
             [
              'game_series_id' => 13,
              'room_id'        => 6303,
              'room_name'      => '十三水常规场中级房',
             ],
             [
              'game_series_id' => 13,
              'room_id'        => 6304,
              'room_name'      => '十三水常规场高级房',
             ],
             [
              'game_series_id' => 13,
              'room_id'        => 6305,
              'room_name'      => '十三水急速场新手房',
             ],
             [
              'game_series_id' => 13,
              'room_id'        => 6306,
              'room_name'      => '十三水急速场初级房',
             ],
             [
              'game_series_id' => 13,
              'room_id'        => 6307,
              'room_name'      => '十三水急速场中级房',
             ],
             [
              'game_series_id' => 13,
              'room_id'        => 6308,
              'room_name'      => '十三水急速场高级房',
             ],
             [
              'game_series_id' => 14,
              'room_id'        => 3801,
              'room_name'      => '幸运五张体验房',
             ],
             [
              'game_series_id' => 14,
              'room_id'        => 3802,
              'room_name'      => '幸运五张初级房',
             ],
             [
              'game_series_id' => 14,
              'room_id'        => 3803,
              'room_name'      => '幸运五张中级房',
             ],
             [
              'game_series_id' => 14,
              'room_id'        => 3804,
              'room_name'      => '幸运五张高级房',
             ],
             [
              'game_series_id' => 16,
              'room_id'        => 3901,
              'room_name'      => '射龙门经典房',
             ],
             [
              'game_series_id' => 16,
              'room_id'        => 3902,
              'room_name'      => '射龙门暴击房',
             ],
             [
              'game_series_id' => 17,
              'room_id'        => 9101,
              'room_name'      => '百家乐体验房',
             ],
             [
              'game_series_id' => 17,
              'room_id'        => 9102,
              'room_name'      => '百家乐初级房',
             ],
             [
              'game_series_id' => 17,
              'room_id'        => 9103,
              'room_name'      => '百家乐中级房',
             ],
             [
              'game_series_id' => 17,
              'room_id'        => 9104,
              'room_name'      => '百家乐高级房',
             ],
             [
              'game_series_id' => 18,
              'room_id'        => 9201,
              'room_name'      => '森林舞会体验房',
             ],
             [
              'game_series_id' => 18,
              'room_id'        => 9202,
              'room_name'      => '森林舞会初级房',
             ],
             [
              'game_series_id' => 18,
              'room_id'        => 9203,
              'room_name'      => '森林舞会中级房',
             ],
             [
              'game_series_id' => 18,
              'room_id'        => 9204,
              'room_name'      => '森林舞会高级房',
             ],
             [
              'game_series_id' => 19,
              'room_id'        => 9301,
              'room_name'      => '百人牛牛体验房',
             ],
             [
              'game_series_id' => 19,
              'room_id'        => 9302,
              'room_name'      => '百人牛牛初级房',
             ],
             [
              'game_series_id' => 19,
              'room_id'        => 9303,
              'room_name'      => '百人牛牛中级房',
             ],
             [
              'game_series_id' => 19,
              'room_id'        => 9304,
              'room_name'      => '百人牛牛高级房',
             ],
             [
              'game_series_id' => 20,
              'room_id'        => 19501,
              'room_name'      => '万人炸金花体验房',
             ],
             [
              'game_series_id' => 20,
              'room_id'        => 19502,
              'room_name'      => '万人炸金花初级房',
             ],
             [
              'game_series_id' => 20,
              'room_id'        => 19503,
              'room_name'      => '万人炸金花中级房',
             ],
             [
              'game_series_id' => 20,
              'room_id'        => 19504,
              'room_name'      => '万人炸金花高级房',
             ],
             [
              'game_series_id' => 21,
              'room_id'        => 6501,
              'room_name'      => '血流成河体验房',
             ],
             [
              'game_series_id' => 21,
              'room_id'        => 6502,
              'room_name'      => '血流成河初级房',
             ],
             [
              'game_series_id' => 21,
              'room_id'        => 6503,
              'room_name'      => '血流成河中级房',
             ],
             [
              'game_series_id' => 21,
              'room_id'        => 6504,
              'room_name'      => '血流成河高级房',
             ],
             [
              'game_series_id' => 22,
              'room_id'        => 8901,
              'room_name'      => '看牌抢庄牛牛体验房',
             ],
             [
              'game_series_id' => 22,
              'room_id'        => 8902,
              'room_name'      => '看牌抢庄牛牛初级房',
             ],
             [
              'game_series_id' => 22,
              'room_id'        => 8903,
              'room_name'      => '看牌抢庄牛牛中级房',
             ],
             [
              'game_series_id' => 22,
              'room_id'        => 8904,
              'room_name'      => '看牌抢庄牛牛高级房',
             ],
             [
              'game_series_id' => 22,
              'room_id'        => 8905,
              'room_name'      => '看牌抢庄牛牛至尊房',
             ],
             [
              'game_series_id' => 22,
              'room_id'        => 8906,
              'room_name'      => '看牌抢庄牛牛王者房',
             ],
             [
              'game_series_id' => 23,
              'room_id'        => 7401,
              'room_name'      => '二人麻将体验房',
             ],
             [
              'game_series_id' => 23,
              'room_id'        => 7402,
              'room_name'      => '二人麻将初级房',
             ],
             [
              'game_series_id' => 23,
              'room_id'        => 7403,
              'room_name'      => '二人麻将中级房',
             ],
             [
              'game_series_id' => 23,
              'room_id'        => 7404,
              'room_name'      => '二人麻将高级房',
             ],
             [
              'game_series_id' => 24,
              'room_id'        => 13501,
              'room_name'      => '幸运转盘',
             ],
             [
              'game_series_id' => 24,
              'room_id'        => 13502,
              'room_name'      => '幸运转盘',
             ],
             [
              'game_series_id' => 24,
              'room_id'        => 13503,
              'room_name'      => '幸运转盘',
             ],
             [
              'game_series_id' => 25,
              'room_id'        => 19401,
              'room_name'      => '金鲨银鲨体验房',
             ],
             [
              'game_series_id' => 25,
              'room_id'        => 19402,
              'room_name'      => '金鲨银鲨初级房',
             ],
             [
              'game_series_id' => 25,
              'room_id'        => 19403,
              'room_name'      => '金鲨银鲨中级房',
             ],
             [
              'game_series_id' => 25,
              'room_id'        => 19404,
              'room_name'      => '金鲨银鲨高级房',
             ],
             [
              'game_series_id' => 26,
              'room_id'        => 19601,
              'room_name'      => '奔驰宝马体验房',
             ],
             [
              'game_series_id' => 26,
              'room_id'        => 19602,
              'room_name'      => '奔驰宝马初级房',
             ],
             [
              'game_series_id' => 26,
              'room_id'        => 19603,
              'room_name'      => '奔驰宝马中级房',
             ],
             [
              'game_series_id' => 26,
              'room_id'        => 19604,
              'room_name'      => '奔驰宝马高级房',
             ],
             [
              'game_series_id' => 27,
              'room_id'        => 19801,
              'room_name'      => '百人骰宝体验房',
             ],
             [
              'game_series_id' => 27,
              'room_id'        => 19802,
              'room_name'      => '百人骰宝初级房',
             ],
             [
              'game_series_id' => 27,
              'room_id'        => 19803,
              'room_name'      => '百人骰宝中级房',
             ],
             [
              'game_series_id' => 27,
              'room_id'        => 19804,
              'room_name'      => '百人骰宝高级房',
             ],
             [
              'game_series_id' => 28,
              'room_id'        => 18101,
              'room_name'      => '单挑牛牛体验房',
             ],
             [
              'game_series_id' => 28,
              'room_id'        => 18102,
              'room_name'      => '单挑牛牛初级房',
             ],
             [
              'game_series_id' => 28,
              'room_id'        => 18103,
              'room_name'      => '单挑牛牛中级房',
             ],
             [
              'game_series_id' => 28,
              'room_id'        => 18104,
              'room_name'      => '单挑牛牛高级房',
             ],
             [
              'game_series_id' => 28,
              'room_id'        => 18105,
              'room_name'      => '单挑牛牛至尊房',
             ],
             [
              'game_series_id' => 28,
              'room_id'        => 18106,
              'room_name'      => '单挑牛牛王者房',
             ],
             [
              'game_series_id' => 29,
              'room_id'        => 19901,
              'room_name'      => '炸金花体验房',
             ],
             [
              'game_series_id' => 29,
              'room_id'        => 19902,
              'room_name'      => '炸金花初级房',
             ],
             [
              'game_series_id' => 29,
              'room_id'        => 19903,
              'room_name'      => '炸金花中级房',
             ],
             [
              'game_series_id' => 29,
              'room_id'        => 19904,
              'room_name'      => '炸金花高级房',
             ],
             [
              'game_series_id' => 29,
              'room_id'        => 19905,
              'room_name'      => '炸金花至尊房',
             ],
             [
              'game_series_id' => 29,
              'room_id'        => 19906,
              'room_name'      => '炸金花王者房',
             ],
             [
              'game_series_id' => 30,
              'room_id'        => 18501,
              'room_name'      => '押宝抢庄牛牛体验房',
             ],
             [
              'game_series_id' => 30,
              'room_id'        => 18502,
              'room_name'      => '押宝抢庄牛牛初级房',
             ],
             [
              'game_series_id' => 30,
              'room_id'        => 18503,
              'room_name'      => '押宝抢庄牛牛中级房',
             ],
             [
              'game_series_id' => 30,
              'room_id'        => 18504,
              'room_name'      => '押宝抢庄牛牛高级房',
             ],
             [
              'game_series_id' => 30,
              'room_id'        => 18505,
              'room_name'      => '押宝抢庄牛牛至尊房',
             ],
             [
              'game_series_id' => 30,
              'room_id'        => 18506,
              'room_name'      => '押宝抢庄牛牛王者房',
             ],
             [
              'game_series_id' => 31,
              'room_id'        => 5101,
              'room_name'      => '人鱼港口',
             ],
             [
              'game_series_id' => 31,
              'room_id'        => 5102,
              'room_name'      => '海王遗迹',
             ],
             [
              'game_series_id' => 31,
              'room_id'        => 5103,
              'room_name'      => '伟大航道',
             ],
             [
              'game_series_id' => 32,
              'room_id'        => 16601,
              'room_name'      => '血战到底体验房',
             ],
             [
              'game_series_id' => 32,
              'room_id'        => 16602,
              'room_name'      => '血战到底初级房',
             ],
             [
              'game_series_id' => 32,
              'room_id'        => 16603,
              'room_name'      => '血战到底中级房',
             ],
             [
              'game_series_id' => 32,
              'room_id'        => 16604,
              'room_name'      => '血战到底高级房',
             ],
             [
              'game_series_id' => 34,
              'room_id'        => 19701,
              'room_name'      => '五星宏辉体验房',
             ],
             [
              'game_series_id' => 34,
              'room_id'        => 19702,
              'room_name'      => '五星宏辉初级房',
             ],
             [
              'game_series_id' => 34,
              'room_id'        => 19703,
              'room_name'      => '五星宏辉中级房',
             ],
             [
              'game_series_id' => 34,
              'room_id'        => 19704,
              'room_name'      => '五星宏辉高级房',
             ],
             [
              'game_series_id' => 35,
              'room_id'        => 18601,
              'room_name'      => '赌场扑克体验房',
             ],
             [
              'game_series_id' => 35,
              'room_id'        => 18602,
              'room_name'      => '赌场扑克初级房',
             ],
             [
              'game_series_id' => 35,
              'room_id'        => 18603,
              'room_name'      => '赌场扑克中级房',
             ],
             [
              'game_series_id' => 35,
              'room_id'        => 18604,
              'room_name'      => '赌场扑克高级房',
             ],
             [
              'game_series_id' => 36,
              'room_id'        => 13701,
              'room_name'      => '港式梭哈新手房',
             ],
             [
              'game_series_id' => 36,
              'room_id'        => 13702,
              'room_name'      => '港式梭哈初级房',
             ],
             [
              'game_series_id' => 36,
              'room_id'        => 13703,
              'room_name'      => '港式梭哈中级房',
             ],
             [
              'game_series_id' => 36,
              'room_id'        => 13704,
              'room_name'      => '港式梭哈高级房',
             ],
             [
              'game_series_id' => 37,
              'room_id'        => 16901,
              'room_name'      => '血战骰宝体验房',
             ],
             [
              'game_series_id' => 37,
              'room_id'        => 16902,
              'room_name'      => '血战骰宝初级房',
             ],
             [
              'game_series_id' => 37,
              'room_id'        => 16903,
              'room_name'      => '血战骰宝中级房',
             ],
             [
              'game_series_id' => 37,
              'room_id'        => 16904,
              'room_name'      => '血战骰宝高级房',
             ],
             [
              'game_series_id' => 38,
              'room_id'        => 18901,
              'room_name'      => '水果机体验房',
             ],
             [
              'game_series_id' => 38,
              'room_id'        => 18902,
              'room_name'      => '水果机初级房',
             ],
             [
              'game_series_id' => 38,
              'room_id'        => 18903,
              'room_name'      => '水果机中级房',
             ],
             [
              'game_series_id' => 38,
              'room_id'        => 18904,
              'room_name'      => '水果机高级房',
             ],
             [
              'game_series_id' => 39,
              'room_id'        => 16101,
              'room_name'      => '幸运夺宝白银宝箱',
             ],
             [
              'game_series_id' => 39,
              'room_id'        => 16102,
              'room_name'      => '幸运夺宝黄金宝箱',
             ],
             [
              'game_series_id' => 39,
              'room_id'        => 16103,
              'room_name'      => '幸运夺宝铂金宝箱',
             ],
             [
              'game_series_id' => 39,
              'room_id'        => 16104,
              'room_name'      => '幸运夺宝钻石宝箱',
             ],
            ],
        );
    }
}
