<?php

use App\Models\Game\GamesType;
use Illuminate\Database\Seeder;

/**
 * Class GameTypeSeeder
 */
class GameTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        GamesType::insert(
            [
                [
                    'id' => 1,
                    'name' => '棋牌游戏',
                    'sign' => 'jianghu_1',
                    'status' => 1,
                ],
                [
                    'id' => 2,
                    'name' => '体育赛事',
                    'sign' => 'jianghu_2',
                    'status' => 1,
                ],
                [
                    'id' => 3,
                    'name' => '捕鱼游戏',
                    'sign' => 'jianghu_3',
                    'status' => 1,
                ],
                [
                    'id' => 4,
                    'name' => '电子游戏',
                    'sign' => 'jianghu_4',
                    'status' => 1,
                ],
                [
                    'id' => 5,
                    'name' => '真人视讯',
                    'sign' => 'jianghu_5',
                    'status' => 1,
                ],
                [
                    'id' => 6,
                    'name' => '彩票投注',
                    'sign' => 'jianghu_6',
                    'status' => 1,
                ],
            ],
        );
    }
}
