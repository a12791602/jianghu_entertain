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
              'balance'    => '30000.0000',
              'frozen'     => '44440.0000',
              'integral'   => null,
              'status'     => 1,
              'tax_status' => 1,
              'created_at' => null,
              'updated_at' => '2020-04-06 20:08:41',
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
            ],
        );
    }
}
