<?php

use App\Models\Systems\SystemUsersHelpCenter;
use Illuminate\Database\Seeder;

/**
 * Class SystemUsersHelpCenterSeeder
 */
class SystemUsersHelpCenterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        SystemUsersHelpCenter::insert(
            [
             [
              'platform_sign'   => 'JHHY',
              'pid'             => 1,
              'title'           => '我是帮助',
              'pic'             => 'uploads/JHHY/set/help/uploads/2020-05-13/2b29ded6b774bed0596511867bcee54b.png',
              'type'            => 1,
              'status'          => 1,
              'add_admin_id'    => 2,
              'update_admin_id' => 3,
              'created_at'      => '2020-05-13 20:06:55',
              'updated_at'      => '2020-05-13 20:36:37',
             ],
             [
              'platform_sign'   => 'JHHY',
              'pid'             => 1,
              'title'           => '帮助设置',
              'pic'             => 'uploads/JHHY/set/help/uploads/2020-05-13/f57d8b1c311a98fb1664ac8cd6cb3b3f.png',
              'type'            => 1,
              'status'          => 1,
              'add_admin_id'    => 3,
              'update_admin_id' => 3,
              'created_at'      => '2020-05-13 20:30:21',
              'updated_at'      => '2020-05-13 20:30:21',
             ],
             [
              'platform_sign'   => 'JHHY',
              'pid'             => 0,
              'title'           => '安全保障',
              'pic'             => null,
              'type'            => 1,
              'status'          => 1,
              'add_admin_id'    => 3,
              'update_admin_id' => 3,
              'created_at'      => '2020-05-13 20:41:59',
              'updated_at'      => '2020-05-13 20:41:59',
             ],
             [
              'platform_sign'   => 'JHHY',
              'pid'             => 0,
              'title'           => '充值提现',
              'pic'             => null,
              'type'            => 1,
              'status'          => 1,
              'add_admin_id'    => 3,
              'update_admin_id' => 3,
              'created_at'      => '2020-05-13 20:42:09',
              'updated_at'      => '2020-05-13 20:42:09',
             ],
             [
              'platform_sign'   => 'JHHY',
              'pid'             => 4,
              'title'           => '安全类',
              'pic'             => 'uploads/JHHY/set/help/uploads/2020-05-13/60bd849d603e32312d56ba250456aedb.png',
              'type'            => 1,
              'status'          => 1,
              'add_admin_id'    => 3,
              'update_admin_id' => 3,
              'created_at'      => '2020-05-13 20:50:50',
              'updated_at'      => '2020-05-13 20:50:50',
             ],
             [
              'platform_sign'   => 'JHHY',
              'pid'             => 4,
              'title'           => '游戏类',
              'pic'             => 'uploads/JHHY/set/help/uploads/2020-05-13/c83d3d96d91b856d51f0dcfb5315c991.png',
              'type'            => 1,
              'status'          => 1,
              'add_admin_id'    => 3,
              'update_admin_id' => 3,
              'created_at'      => '2020-05-13 20:51:13',
              'updated_at'      => '2020-05-13 20:51:13',
             ],
             [
              'platform_sign'   => 'JHHY',
              'pid'             => 4,
              'title'           => '充提类',
              'pic'             => 'uploads/JHHY/set/help/uploads/2020-05-13/bdd4b1d3a220b462fb7bcca818f4b72e.png',
              'type'            => 1,
              'status'          => 1,
              'add_admin_id'    => 3,
              'update_admin_id' => 3,
              'created_at'      => '2020-05-13 20:51:31',
              'updated_at'      => '2020-05-13 20:51:31',
             ],
             [
              'platform_sign'   => 'JHHY',
              'pid'             => 5,
              'title'           => '充值类',
              'pic'             => 'uploads/JHHY/set/help/uploads/2020-05-13/d3962ec906aae1e0627c26f1db3a9a6d.png',
              'type'            => 1,
              'status'          => 1,
              'add_admin_id'    => 3,
              'update_admin_id' => 3,
              'created_at'      => '2020-05-13 20:52:00',
              'updated_at'      => '2020-05-13 20:52:00',
             ],
             [
              'platform_sign'   => 'JHHY',
              'pid'             => 5,
              'title'           => '提款类',
              'pic'             => 'uploads/JHHY/set/help/uploads/2020-05-13/82e753f8d8070b9aabe74ffb5fe345a4.png',
              'type'            => 1,
              'status'          => 1,
              'add_admin_id'    => 3,
              'update_admin_id' => 3,
              'created_at'      => '2020-05-13 20:52:14',
              'updated_at'      => '2020-05-13 20:52:14',
             ],
             [
              'platform_sign'   => 'JHHY',
              'pid'             => 0,
              'title'           => '兑奖',
              'pic'             => null,
              'type'            => 1,
              'status'          => 1,
              'add_admin_id'    => 3,
              'update_admin_id' => 3,
              'created_at'      => '2020-05-13 20:52:35',
              'updated_at'      => '2020-05-13 20:52:35',
             ],
             [
              'platform_sign'   => 'JHHY',
              'pid'             => 11,
              'title'           => '如何兑奖',
              'pic'             => 'uploads/JHHY/set/help/uploads/2020-05-13/c5628ce53f58983f1df49249af4c336f.png',
              'type'            => 1,
              'status'          => 1,
              'add_admin_id'    => 3,
              'update_admin_id' => 3,
              'created_at'      => '2020-05-13 20:52:48',
              'updated_at'      => '2020-05-13 20:52:48',
             ],
            ],
        );
    }
}
