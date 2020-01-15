<?php

use App\Models\Systems\SystemDomain;
use Illuminate\Database\Seeder;

/**
 * Class SystemDomainSeeder
 */
class SystemDomainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        SystemDomain::insert(
            [
             [
              'platform_sign' => 'test',
              'admin_id'      => null,
              'domain'        => 'h5.jianghu.local',
              'status'        => 1,
              'type'          => null,
              'is_default'    => 0,
             ],
             [
              'platform_sign' => 'test',
              'admin_id'      => null,
              'domain'        => 'madmin.jianghu.local',
              'status'        => 1,
              'type'          => null,
              'is_default'    => 0,
             ],
             [
              'platform_sign' => 'test',
              'admin_id'      => null,
              'domain'        => 'cadmin.jianghu.local',
              'status'        => 1,
              'type'          => null,
              'is_default'    => 0,
             ],
             [
              'platform_sign' => 'test',
              'admin_id'      => null,
              'domain'        => 'api.jianghu.local',
              'status'        => 1,
              'type'          => null,
              'is_default'    => 0,
             ],
             [
              'platform_sign' => 'test',
              'admin_id'      => null,
              'domain'        => '10.10.50.127:8080',
              'status'        => 1,
              'type'          => null,
              'is_default'    => 0,
             ],
             [
              'platform_sign' => 'test',
              'admin_id'      => null,
              'domain'        => '10.10.40.196:7456',
              'status'        => 1,
              'type'          => null,
              'is_default'    => 0,
             ],
            ],
        );
    }
}
