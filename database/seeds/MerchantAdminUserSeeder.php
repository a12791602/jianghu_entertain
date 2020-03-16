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
              'platform_id'     => 1,
              'platform_sign'   => 'jhhy',
              'chargeable_fund' => 100,
             ],
             [
              'id'              => '2',
              'name'            => 'Charon',
              'email'           => 'ezreal0520@gmail.com',
              'password'        => '$2y$10$OjyyasS6GMcRoD4cwASRzOchhbGRRUjoXduWIwSj3MZ4gLGeT9S6W',
              'remember_token'  => '',
              'group_id'        => '2',
              'status'          => '1',
              'platform_id'     => 1,
              'platform_sign'   => 'jhhy',
              'chargeable_fund' => 100,
             ],
             [
              'id'              => '3',
              'name'            => 'aaron',
              'email'           => 'aaron@qq.com',
              'password'        => '$2y$10$hKf16yCcHI3gaPT06DVOle.uRM.dOugg6zt4A91qXDptxnGZEjOqi',
              'remember_token'  => '',
              'group_id'        => '2',
              'status'          => '1',
              'platform_id'     => 1,
              'platform_sign'   => 'jhhy',
              'chargeable_fund' => 100,
             ],
            ],
        );
    }
}
