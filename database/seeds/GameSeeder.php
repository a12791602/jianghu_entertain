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
              'type_id'      => 1,
              'vendor_id'    => 1,
              'name'         => '开心下象棋',
              'sign'         => 'kxxxq',
              'request_mode' => 1,
              'status'       => 1,
             ],
             [
              'type_id'      => 1,
              'vendor_id'    => 1,
              'name'         => '斗地主',
              'sign'         => 'ddz',
              'request_mode' => 1,
              'status'       => 1,
             ],
             [
              'type_id'      => 2,
              'vendor_id'    => 1,
              'name'         => '北京PK10',
              'sign'         => 'bjpk',
              'request_mode' => 1,
              'status'       => 1,
             ],
            ],
        );
    }
}
