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
              'item'        => '2.00',
              'probability' => '60.00',
              'created_at'  => null,
              'updated_at'  => null,
             ],
             [
              'id'          => 2,
              'item'        => '10.00',
              'probability' => '30.00',
              'created_at'  => null,
              'updated_at'  => null,
             ],
             [
              'id'          => 3,
              'item'        => '50.00',
              'probability' => '5.00',
              'created_at'  => null,
              'updated_at'  => null,
             ],
             [
              'id'          => 4,
              'item'        => '80.00',
              'probability' => '3.00',
              'created_at'  => null,
              'updated_at'  => null,
             ],
             [
              'id'          => 5,
              'item'        => '90.00',
              'probability' => '1.00',
              'created_at'  => null,
              'updated_at'  => null,
             ],
             [
              'id'          => 6,
              'item'        => '100.00',
              'probability' => '1.00',
              'created_at'  => null,
              'updated_at'  => null,
             ],
            ],
        );
    }
}
