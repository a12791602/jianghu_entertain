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
             [
              'id'              => '1',
              'name'            => 'ling',
              'email'           => 'ling@gmail.com',
              'password'        => '$2y$10$MKKGeBpoDfzfcewJ4Mrk.uTCIcSSvowXwPeKw0LNwY8K60pz7QL3G',
              'remember_token'  => '',
              'group_id'        => '1',
              'status'          => '1',
              'platform_sign'   => 'jhhy',
              'chargeable_fund' => 100,
             ],
             [
              'id'              => '2',
              'name'            => 'Charon',
              'email'           => 'ezreal0520@gmail.com',
              'password'        => '$2y$10$LKALlH4bFlwLwiWmF.Pc4eWU4sHZpy5CMi0o3GEIKWNP0XJeHOCGy',
              'remember_token'  => '',
              'group_id'        => '2',
              'status'          => '1',
              'platform_sign'   => 'jhhy',
              'chargeable_fund' => 100,
             ],
            ],
        );
    }
}
