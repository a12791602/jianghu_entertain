<?php

use App\Models\Game\GameTheirAccountType;
use Illuminate\Database\Seeder;

/**
 * Class GameTheirAccountTypeSeeder
 */
class GameTheirAccountTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        GameTheirAccountType::insert(
            [
             [
              'id'          => 1,
              'vendor_id'   => 2,
              'code'        => '0',
              'in_out'      => 2,
              'description' => '投注',
             ],
             [
              'id'          => 2,
              'vendor_id'   => 2,
              'code'        => '1',
              'in_out'      => 2,
              'description' => '追号',
             ],
             [
              'id'          => 3,
              'vendor_id'   => 2,
              'code'        => '2',
              'in_out'      => 2,
              'description' => '打赏',
             ],
             [
              'id'          => 4,
              'vendor_id'   => 2,
              'code'        => '3',
              'in_out'      => 1,
              'description' => '投注失败',
             ],
             [
              'id'          => 5,
              'vendor_id'   => 2,
              'code'        => '4',
              'in_out'      => 1,
              'description' => '追号失败',
             ],
             [
              'id'          => 6,
              'vendor_id'   => 2,
              'code'        => '5',
              'in_out'      => 1,
              'description' => '打赏失败',
             ],
             [
              'id'          => 7,
              'vendor_id'   => 2,
              'code'        => '6',
              'in_out'      => 1,
              'description' => '中奖后停止追号',
             ],
             [
              'id'          => 8,
              'vendor_id'   => 2,
              'code'        => '7',
              'in_out'      => 1,
              'description' => '撤单',
             ],
             [
              'id'          => 9,
              'vendor_id'   => 2,
              'code'        => '8',
              'in_out'      => 1,
              'description' => '取消追号',
             ],
             [
              'id'          => 10,
              'vendor_id'   => 2,
              'code'        => '9',
              'in_out'      => 1,
              'description' => '取消打赏',
             ],
             [
              'id'          => 11,
              'vendor_id'   => 2,
              'code'        => '10',
              'in_out'      => 2,
              'description' => '撤单 取消投注 失败',
             ],
             [
              'id'          => 12,
              'vendor_id'   => 2,
              'code'        => '11',
              'in_out'      => 2,
              'description' => '取消追号失 败',
             ],
             [
              'id'          => 13,
              'vendor_id'   => 2,
              'code'        => '12',
              'in_out'      => 2,
              'description' => '取消打赏失败',
             ],
             [
              'id'          => 14,
              'vendor_id'   => 2,
              'code'        => '13',
              'in_out'      => 2,
              'description' => '颁奖',
             ],
             [
              'id'          => 15,
              'vendor_id'   => 2,
              'code'        => '14',
              'in_out'      => 1,
              'description' => '重新颁奖',
             ],
             [
              'id'          => 16,
              'vendor_id'   => 2,
              'code'        => '15',
              'in_out'      => 1,
              'description' => '整期撤单',
             ],
             [
              'id'          => 17,
              'vendor_id'   => 2,
              'code'        => '16',
              'in_out'      => 2,
              'description' => 'VR 即开游戏 投注',
             ],
             [
              'id'          => 18,
              'vendor_id'   => 2,
              'code'        => '17',
              'in_out'      => 1,
              'description' => 'VR 即开游戏 投注失败',
             ],
             [
              'id'          => 19,
              'vendor_id'   => 2,
              'code'        => '18',
              'in_out'      => 1,
              'description' => 'VR 即开游戏 颁奖',
             ],
            ],
        );
    }
}
