<?php

use App\Models\User\UsersCommissionConfigDetail;
use Illuminate\Database\Seeder;

/**
 * Class UsersCommissionConfigDetailSeeder
 */
class UsersCommissionConfigDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        UsersCommissionConfigDetail::insert(
            [
             [
              'config_id'     => 1,
              'grade_id'      => 1,
              'percent'       => 0.1,
              'grade_exp_max' => 1999,
             ],
             [
              'config_id'     => 1,
              'grade_id'      => 2,
              'percent'       => 0.2,
              'grade_exp_max' => 2999,
             ],
             [
              'config_id'     => 1,
              'grade_id'      => 3,
              'percent'       => 0.3,
              'grade_exp_max' => 3999,
             ],
             [
              'config_id'     => 1,
              'grade_id'      => 4,
              'percent'       => 0.3,
              'grade_exp_max' => 4999,
             ],
             [
              'config_id'     => 1,
              'grade_id'      => 5,
              'percent'       => 0.3,
              'grade_exp_max' => 5999,
             ],
             [
              'config_id'     => 1,
              'grade_id'      => 6,
              'percent'       => 0.3,
              'grade_exp_max' => 6999,
             ],
             [
              'config_id'     => 1,
              'grade_id'      => 7,
              'percent'       => 0.3,
              'grade_exp_max' => 7999,
             ],
             [
              'config_id'     => 2,
              'grade_id'      => 1,
              'percent'       => 0.1,
              'grade_exp_max' => 1999,
             ],
             [
              'config_id'     => 2,
              'grade_id'      => 2,
              'percent'       => 0.2,
              'grade_exp_max' => 2999,
             ],
             [
              'config_id'     => 2,
              'grade_id'      => 3,
              'percent'       => 0.3,
              'grade_exp_max' => 3999,
             ],
             [
              'config_id'     => 2,
              'grade_id'      => 4,
              'percent'       => 0.3,
              'grade_exp_max' => 4999,
             ],
             [
              'config_id'     => 2,
              'grade_id'      => 5,
              'percent'       => 0.3,
              'grade_exp_max' => 5999,
             ],
             [
              'config_id'     => 2,
              'grade_id'      => 6,
              'percent'       => 0.3,
              'grade_exp_max' => 6999,
             ],
             [
              'config_id'     => 2,
              'grade_id'      => 7,
              'percent'       => 0.3,
              'grade_exp_max' => 7999,
             ],
            ],
        );
    }
}
