<?php

use App\Models\Admin\MerchantAdminUser;
use Illuminate\Database\Seeder;

/**
 * Class MerchantAdminUserSeeder
 */
class MerchantAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        MerchantAdminUser::insert(
            [
                'name' => 'ling',
                'email' => 'ling@gmail.com',
                'password' => '$2y$10$MKKGeBpoDfzfcewJ4Mrk.uTCIcSSvowXwPeKw0LNwY8K60pz7QL3G',
                'is_test' => 0,
                'status' => 1,
                'platform_sign' => 'b',
            ],
        );
    }
}
