<?php

use App\Models\Activity\ActivitiesConfigRegFirstimeRandom;
use Illuminate\Database\Seeder;

/**
 * Class ActivitiesConfigRegFirstimeRandomSeeder
 */
class ActivitiesConfigRegFirstimeRandomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        ActivitiesConfigRegFirstimeRandom::insert(
            [
             [
              'id'          => 1,
              'item'        => '一等奖',
              'amount'      => '100.00',
              'probability' => '1.00',
             ],
             [
              'id'          => 2,
              'item'        => '二等奖',
              'amount'      => '90.00',
              'probability' => '1.00',
             ],
             [
              'id'          => 3,
              'item'        => '三等奖',
              'amount'      => '80.00',
              'probability' => '3.00',
             ],
             [
              'id'          => 4,
              'item'        => '四等奖',
              'amount'      => '50.00',
              'probability' => '5.00',
             ],
             [
              'id'          => 5,
              'item'        => '注五等奖',
              'amount'      => '10.00',
              'probability' => '30.00',
             ],
             [
              'id'          => 6,
              'item'        => '六等奖',
              'amount'      => '2.00',
              'probability' => '60.00',
             ],
            ],
        );
    }
}
