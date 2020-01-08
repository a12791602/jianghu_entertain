<?php

use App\Models\User\FrontendUsersAccount;
use Illuminate\Database\Seeder;

/**
 * Class FrontendUserAccountSeeder
 */
class FrontendUserAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        FrontendUsersAccount::insert(
            [
                [
                    'user_id' => '1',
                    'balance' => 999022347.8236,
                    'frozen' => 86853.2200,
                    'status' => 1,
                ],
                [
                    'user_id' => '2',
                    'balance' => 1000000.0000,
                    'frozen' => 0.0000,
                    'status' => 1,
                ],
                [
                    'user_id' => '3',
                    'balance' => 1000000.0000,
                    'frozen' => 0.0000,
                    'status' => 1,
                ],
            ],
        );
    }
}
