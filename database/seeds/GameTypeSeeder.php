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
                    'id' => 2,
                    'name' => '捕鱼',
                    'sign' => 'fish1',
                    'status' => 1,
                ],
                [
                    'id' => 3,
                    'name' => '捕鱼21111',
                    'sign' => 'FISH221111',
                    'status' => 1,
                ],
                [
                    'id' => 4,
                    'name' => '捕鱼3',
                    'sign' => 'FISH3',
                    'status' => 1,
                ],
                [
                    'id' => 5,
                    'name' => '捕鱼4',
                    'sign' => 'FISH4',
                    'status' => 1,
                ],
            ],
        );
    }
}
