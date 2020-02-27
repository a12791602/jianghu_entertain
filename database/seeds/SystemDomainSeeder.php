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
              'platform_sign' => 'jhhy',
              'admin_id'      => null,
              'domain'        => 'h5.jianghu.local',
              'status'        => 1,
              'type'          => null,
              'is_default'    => 0,
             ],
             [
              'platform_sign' => 'jhhy',
              'admin_id'      => null,
              'domain'        => 'madmin.jianghu.local',
              'status'        => 1,
              'type'          => null,
              'is_default'    => 0,
             ],
             [
              'platform_sign' => 'jhhy',
              'admin_id'      => null,
              'domain'        => 'cadmin.jianghu.local',
              'status'        => 1,
              'type'          => null,
              'is_default'    => 0,
             ],
             [
              'platform_sign' => 'jhhy',
              'admin_id'      => null,
              'domain'        => 'cadmin.397017.com',
              'status'        => 1,
              'type'          => null,
              'is_default'    => 0,
             ],
             [
              'platform_sign' => 'jhhy',
              'admin_id'      => null,
              'domain'        => 'api.jianghu.local',
              'status'        => 1,
              'type'          => null,
              'is_default'    => 0,
             ],
             [
              'platform_sign' => 'jhhy',
              'admin_id'      => null,
              'domain'        => '10.10.50.127:8080',
              'status'        => 1,
              'type'          => null,
              'is_default'    => 0,
             ],
             [
              'platform_sign' => 'jhhy',
              'admin_id'      => null,
              'domain'        => '10.10.50.198:8081',
              'status'        => 1,
              'type'          => null,
              'is_default'    => 0,
             ],
             [
              'platform_sign' => 'jhhy',
              'admin_id'      => null,
              'domain'        => '10.10.40.196:7456',
              'status'        => 1,
              'type'          => null,
              'is_default'    => 0,
             ],
             [
              'platform_sign' => 'jhhy',
              'admin_id'      => null,
              'domain'        => '10.10.50.209:8081',
              'status'        => 1,
              'type'          => null,
              'is_default'    => 0,
             ],
             [
              'platform_sign' => 'jhhy',
              'admin_id'      => null,
              'domain'        => 'api.397017.com',
              'status'        => 1,
              'type'          => null,
              'is_default'    => 0,
             ],
             [
              'platform_sign' => 'jhhy',
              'admin_id'      => null,
              'domain'        => 'app.397017.com',
              'status'        => 1,
              'type'          => null,
              'is_default'    => 0,
             ],
             [
              'platform_sign' => 'jhhy',
              'admin_id'      => null,
              'domain'        => 'm.jianghu.com',
              'status'        => 1,
              'type'          => null,
              'is_default'    => 0,
             ],
             [
              'platform_sign' => 'jhhy',
              'admin_id'      => null,
              'domain'        => 'app.jianghu.com',
              'status'        => 1,
              'type'          => null,
              'is_default'    => 0,
             ],
            ],
        );
    }
}
