<?php

use App\Models\Systems\SystemSmsConfig;
use Illuminate\Database\Seeder;

/**
 * Class SystemSmsConfigSeeder
 */
class SystemSmsConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        SystemSmsConfig::insert(
            [
             [
              'id'             => 1,
              'name'           => '测试短信配置',
              'sign'           => 'JHHY',
              'sms_num'        => 10000,
              'sms_remaining'  => 500,
              'author_id'      => 2,
              'last_editor_id' => 2,
              'status'         => 1,
              'created_at'     => '2020-04-22 20:00:46',
              'updated_at'     => '2020-04-22 20:00:46',
             ],
            ],
        );
    }
}
