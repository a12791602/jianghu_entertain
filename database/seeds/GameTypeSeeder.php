<?php

use App\Models\Game\GameType;
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
        GameType::insert(
            [
             [
              'id'     => 1,
              'name'   => '棋牌游戏',
              'sign'   => 'tarot',
              'status' => 1,
              'sort'   => 1,
             ],
             [
              'id'     => 2,
              'name'   => '体育赛事',
              'sign'   => 'sport',
              'status' => 1,
              'sort'   => 2,
             ],
             [
              'id'     => 3,
              'name'   => '捕鱼游戏',
              'sign'   => 'fishing',
              'status' => 1,
              'sort'   => 3,
             ],
             [
              'id'     => 4,
              'name'   => '电子游戏',
              'sign'   => 'e_game',
              'status' => 1,
              'sort'   => 4,
             ],
             [
              'id'     => 5,
              'name'   => '真人视讯',
              'sign'   => 'live',
              'status' => 1,
              'sort'   => 5,
             ],
             [
              'id'     => 6,
              'name'   => '彩票游戏',
              'sign'   => 'lottery',
              'status' => 1,
              'sort'   => 6,
             ],
            ],
        );
    }
}
