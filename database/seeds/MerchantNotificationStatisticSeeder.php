<?php

use App\Models\Notification\MerchantNotificationStatistic;
use Illuminate\Database\Seeder;

/**
 * Class MerchantNotificationStatisticSeeder
 */
class MerchantNotificationStatisticSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        MerchantNotificationStatistic::insert(
            [
             [
              'id'           => 1,
              'platform_id'  => 1,
              'message_type' => 'email',
              'count'        => 1,
              'created_at'   => null,
              'updated_at'   => '2020-04-20 20:52:16',
             ],
             [
              'id'           => 2,
              'platform_id'  => 1,
              'message_type' => 'online_top_up',
              'count'        => 10,
              'created_at'   => null,
              'updated_at'   => null,
             ],
             [
              'id'           => 3,
              'platform_id'  => 1,
              'message_type' => 'offline_top_up',
              'count'        => 1,
              'created_at'   => null,
              'updated_at'   => '2020-04-20 22:21:17',
             ],
             [
              'id'           => 4,
              'platform_id'  => 1,
              'message_type' => 'withdrawal_order',
              'count'        => 4,
              'created_at'   => null,
              'updated_at'   => '2020-04-20 22:28:52',
             ],
             [
              'id'           => 5,
              'platform_id'  => 1,
              'message_type' => 'withdrawal_review',
              'count'        => 1,
              'created_at'   => null,
              'updated_at'   => '2020-04-20 22:29:02',
             ],
            ],
        );
    }
}
