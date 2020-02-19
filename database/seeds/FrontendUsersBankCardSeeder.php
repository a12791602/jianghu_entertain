<?php

use App\Models\User\FrontendUsersBankCard;
use Illuminate\Database\Seeder;

/**
 * Class FrontendUsersBankCardSeeder
 */
class FrontendUsersBankCardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        FrontendUsersBankCard::insert(
            [
             [
              'platform_sign' => 'jhhy',
              'user_id'       => 2,
              'bank_id'       => 0,
              'owner_name'    => '亚索',
              'card_number'   => '18844446666',
              'branch'        => null,
              'code'          => 'ALIPAY',
              'status'        => 1,
              'type'          => 2,
              'created_at'    => '2020-02-12 10:18:09',
              'updated_at'    => '2020-02-12 10:18:09',
             ],
             [
              'platform_sign' => 'jhhy',
              'user_id'       => 2,
              'bank_id'       => 3,
              'owner_name'    => '亚索',
              'card_number'   => '6228480402564890018',
              'branch'        => '苏州路6号',
              'code'          => 'ABC',
              'status'        => 1,
              'type'          => 1,
              'created_at'    => '2020-02-12 10:18:21',
              'updated_at'    => '2020-02-12 10:18:21',
             ],
            ],
        );
    }
}
