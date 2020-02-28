<?php

use App\Models\User\FrontendUserLevelBenefit;
use Illuminate\Database\Seeder;

/**
 * Class FrontendUserLevelBenefitSeeder
 */
class FrontendUserLevelBenefitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        FrontendUserLevelBenefit::insert(
            [
             [
              'user_id' => 1,
              'level'   => 0,
             ],
             [
              'user_id' => 1,
              'level'   => 1,
             ],
             [
              'user_id' => 1,
              'level'   => 2,
             ],
             [
              'user_id' => 2,
              'level'   => 0,
             ],
             [
              'user_id' => 2,
              'level'   => 1,
             ],
             [
              'user_id' => 3,
              'level'   => 0,
             ],
            ],
        );
    }
}
