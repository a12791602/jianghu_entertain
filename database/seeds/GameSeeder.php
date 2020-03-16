<?php

use App\Models\Game\Game;
use Illuminate\Database\Seeder;

/**
 * Class GameSeeder
 */
class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Game::insert(
            [
             [
              'id'            => 1,
              'type_id'       => 1,
              'type_child_id' => 2,
              'vendor_id'     => 1,
              'name'          => '游戏大厅',
              'sign'          => '0',
              'request_mode'  => 1,
              'status'        => 1,
             ],
             [
              'id'            => 2,
              'type_id'       => 1,
              'type_child_id' => 1,
              'vendor_id'     => 1,
              'name'          => '德州扑克牌',
              'sign'          => '620',
              'request_mode'  => 1,
              'status'        => 1,
             ],
             [
              'id'            => 3,
              'type_id'       => 2,
              'type_child_id' => 1,
              'vendor_id'     => 1,
              'name'          => '炸金花',
              'sign'          => '220',
              'request_mode'  => 1,
              'status'        => 1,
             ],
             [
              'id'            => 4,
              'type_id'       => 1,
              'type_child_id' => null,
              'vendor_id'     => 2,
              'name'          => '三公',
              'sign'          => '860',
              'request_mode'  => 1,
              'status'        => 1,
             ],
            ],
        );
    }
}
