<?php

use App\Models\User\FrontendUserLevel;
use Illuminate\Database\Seeder;

/**
 * Class FrontendUserLevelsSeeder
 */
class FrontendUserLevelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        FrontendUserLevel::insert(
            [
             [
              'level'          => 1,
              'platform_sign'  => 'jhhy',
              'experience_min' => 1,
              'experience_max' => 100,
              'grade_gift'     => 5.88,
              'week_gift'      => 5.88,
             ],
             [
              'level'          => 2,
              'platform_sign'  => 'jhhy',
              'experience_min' => 101,
              'experience_max' => 200,
              'grade_gift'     => 10.88,
              'week_gift'      => 10.88,
             ],
             [
              'level'          => 3,
              'platform_sign'  => 'jhhy',
              'experience_min' => 201,
              'experience_max' => 300,
              'grade_gift'     => 15.88,
              'week_gift'      => 15.88,
             ],
             [
              'level'          => 4,
              'platform_sign'  => 'jhhy',
              'experience_min' => 301,
              'experience_max' => 500,
              'grade_gift'     => 20.88,
              'week_gift'      => 20.88,
             ],
             [
              'level'          => 5,
              'platform_sign'  => 'jhhy',
              'experience_min' => 501,
              'experience_max' => 1000,
              'grade_gift'     => 25.88,
              'week_gift'      => 25.88,
             ],
             [
              'level'          => 6,
              'platform_sign'  => 'jhhy',
              'experience_min' => 1001,
              'experience_max' => 2000,
              'grade_gift'     => 30.88,
              'week_gift'      => 30.88,
             ],
             [
              'level'          => 7,
              'platform_sign'  => 'jhhy',
              'experience_min' => 2001,
              'experience_max' => 5000,
              'grade_gift'     => 35.88,
              'week_gift'      => 35.88,
             ],
             [
              'level'          => 8,
              'platform_sign'  => 'jhhy',
              'experience_min' => 5001,
              'experience_max' => 10000,
              'grade_gift'     => 40.88,
              'week_gift'      => 40.88,
             ],
             [
              'level'          => 9,
              'platform_sign'  => 'jhhy',
              'experience_min' => 10000,
              'experience_max' => 999999,
              'grade_gift'     => 45.88,
              'week_gift'      => 45.88,
             ],
            ],
        );
    }
}
