<?php

use App\Models\User\UsersCommissionConfig;
use Illuminate\Database\Seeder;

/**
 * Class UsersCommissionConfigSeeder
 */
class UsersCommissionConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        UsersCommissionConfig::insert(
            [
             [
              'id'               => 1,
              'platform_sign'    => 'JHHY',
              'game_type_sign'   => 'live',
              'game_vendor_sign' => 'VR',
              'bet'              => 200,
             ],
             [
              'id'               => 2,
              'platform_sign'    => 'JHHY',
              'game_type_sign'   => 'sport',
              'game_vendor_sign' => 'IM',
              'bet'              => 500,
             ],
            ],
        );
    }
}
