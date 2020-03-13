<?php

use App\Models\Systems\SystemPlatform;
use Illuminate\Database\Seeder;

/**
 * Class SystemPlatformSeeder
 */
class SystemPlatformSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        SystemPlatform::insert(
            [
             'id'            => 1,
             'cn_name'       => '江湖互娱',
             'en_name'       => 'jh_entertainment',
             'sign'          => 'jhhy',
             'agency_method' => '1,2',
             'start_time'    => '2019-12-01 00:00:00',
             'end_time'      => '2022-12-01 00:00:00',
             'pc_skin_id'    => 1,
             'h5_skin_id'    => 2,
             'app_skin_id'   => 3,
             'owner_id'      => 1,
             'status'        => 1,
             'sms_num'       => 10000,
             'created_at'    => '2020-01-01 00:00:00',
            ],
        );
    }
}
