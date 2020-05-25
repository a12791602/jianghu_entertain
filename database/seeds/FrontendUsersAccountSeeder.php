<?php

use App\Models\User\FrontendUsersAccount;
use Illuminate\Database\Seeder;

/**
 * Class FrontendUsersAccountSeeder
 */
class FrontendUsersAccountSeeder extends Seeder
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
              'id'         => 1,
              'user_id'    => 1,
              'balance'    => '999022347.8236',
              'frozen'     => '0.0000',
              'integral'   => null,
              'status'     => 1,
              'tax_status' => 0,
              'created_at' => null,
              'updated_at' => null,
             ],
             [
              'id'         => 2,
              'user_id'    => 2,
              'balance'    => '15067.0000',
              'frozen'     => '50441.0000',
              'integral'   => null,
              'status'     => 1,
              'tax_status' => 1,
              'created_at' => null,
              'updated_at' => '2020-05-25 12:32:38',
             ],
             [
              'id'         => 3,
              'user_id'    => 3,
              'balance'    => '2000000.0000',
              'frozen'     => '0.0000',
              'integral'   => null,
              'status'     => 1,
              'tax_status' => 0,
              'created_at' => null,
              'updated_at' => null,
             ],
             [
              'id'         => 4,
              'user_id'    => 4,
              'balance'    => '0.0000',
              'frozen'     => '0.0000',
              'integral'   => null,
              'status'     => 1,
              'tax_status' => 0,
              'created_at' => '2020-05-23 20:40:50',
              'updated_at' => '2020-05-23 20:40:50',
             ],
             [
              'id'         => 5,
              'user_id'    => 5,
              'balance'    => '0.0000',
              'frozen'     => '0.0000',
              'integral'   => null,
              'status'     => 1,
              'tax_status' => 0,
              'created_at' => '2020-05-23 20:46:56',
              'updated_at' => '2020-05-23 20:46:56',
             ],
             [
              'id'         => 6,
              'user_id'    => 6,
              'balance'    => '0.0000',
              'frozen'     => '0.0000',
              'integral'   => null,
              'status'     => 1,
              'tax_status' => 0,
              'created_at' => '2020-05-23 20:48:09',
              'updated_at' => '2020-05-23 20:48:09',
             ],
             [
              'id'         => 7,
              'user_id'    => 7,
              'balance'    => '0.0000',
              'frozen'     => '0.0000',
              'integral'   => null,
              'status'     => 1,
              'tax_status' => 0,
              'created_at' => '2020-05-23 20:48:33',
              'updated_at' => '2020-05-23 20:48:33',
             ],
             [
              'id'         => 8,
              'user_id'    => 8,
              'balance'    => '0.0000',
              'frozen'     => '0.0000',
              'integral'   => null,
              'status'     => 1,
              'tax_status' => 0,
              'created_at' => '2020-05-23 20:53:33',
              'updated_at' => '2020-05-23 20:53:33',
             ],
            ],
        );
    }
}
