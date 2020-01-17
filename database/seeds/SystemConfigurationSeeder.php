<?php

use App\Models\Systems\SystemConfiguration;
use Illuminate\Database\Seeder;

/**
 * Class SystemConfigurationSeeder
 */
class SystemConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        SystemConfiguration::insert(
            [
             [
              'platform_sign'        => 'test',
              'pid'                  => 0,
              'sign'                 => 'is_crypt_data',
              'name'                 => '传输数据是否加密',
              'value'                => 1,
              'add_admin_id'         => 2,
              'last_update_admin_id' => 2,
              'status'               => 1,
             ],
            ],
        );
    }
}
