<?php

use App\Models\User\UsersGrade;
use Illuminate\Database\Seeder;

/**
 * Class UsersGradesSeeder
 */
class UsersGradesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        UsersGrade::insert(
            [
                [
                    'name' => 'VIP1',
                    'platform_sign' => 'test',
                    'experience_min' => 0.0000,
                    'experience_max' => 100.0000,
                    'grade_gift' => 1.0000,
                    'week_gift' => 1.0000,
                ],
                [
                    'name' => 'VIP2',
                    'platform_sign' => 'test',
                    'experience_min' => 101.0000,
                    'experience_max' => 200.0000,
                    'grade_gift' => 1.0000,
                    'week_gift' => 1.0000,
                ],
                [
                    'name' => 'VIP3',
                    'platform_sign' => 'test',
                    'experience_min' => 201.0000,
                    'experience_max' => 300.0000,
                    'grade_gift' => 4.0000,
                    'week_gift' => 4.0000,
                ],
                [
                    'name' => 'VIP4',
                    'platform_sign' => 'test',
                    'experience_min' => 301.0000,
                    'experience_max' => 500.0000,
                    'grade_gift' => 10.0000,
                    'week_gift' => 10.0000,
                ],
                [
                    'name' => 'VIP5',
                    'platform_sign' => 'test',
                    'experience_min' => 501.0000,
                    'experience_max' => 1000.0000,
                    'grade_gift' => 15.0000,
                    'week_gift' => 15.0000,
                ],
                [
                    'name' => 'VIP6',
                    'platform_sign' => 'test',
                    'experience_min' => 1001.0000,
                    'experience_max' => 2000.0000,
                    'grade_gift' => 20.0000,
                    'week_gift' => 20.0000,
                ],
                [
                    'name' => 'VIP7',
                    'platform_sign' => 'test',
                    'experience_min' => 2001.0000,
                    'experience_max' => 5000.0000,
                    'grade_gift' => 20.0000,
                    'week_gift' => 20.0000,
                ],
                [
                    'name' => 'VIP8',
                    'platform_sign' => 'test',
                    'experience_min' => 5001.0000,
                    'experience_max' => 10000.0000,
                    'grade_gift' => 20.0000,
                    'week_gift' => 20.0000,
                ],
                [
                    'name' => 'VIP9',
                    'platform_sign' => 'test',
                    'experience_min' => 10000.0000,
                    'experience_max' => 999999.0000,
                    'grade_gift' => 20.0000,
                    'week_gift' => 20.0000,
                ],
            ],
        );
    }
}
