<?php

use App\Models\Systems\SystemFePageBanner;
use Illuminate\Database\Seeder;

/**
 * Class SystemFePageBannerSeeder
 */
class SystemFePageBannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        SystemFePageBanner::insert(
            [
             [
              'title'        => '无限极代理',
              'pic_path'     => 'uploads/jhhy/pic/slide/2020-04-23/f633ae459e72b655971c09a593e9f7e4.png',
              'type'         => 1,
              'redirect_url' => 'promote',
              'status'       => 1,
              'flag'         => 1,
             ],
             [
              'title'        => '不定时幸运',
              'pic_path'     => 'uploads/jhhy/pic/slide/2020-04-23/705d33f291acc33ab667044d8cc061cc.png',
              'type'         => 1,
              'redirect_url' => 'promote',
              'status'       => 1,
              'flag'         => 1,
             ],
             [
              'title'        => '未赌先赢',
              'pic_path'     => 'uploads/jhhy/pic/slide/2020-04-23/f0fafe04c748200b8aeb0da91fc75810.png',
              'type'         => 2,
              'redirect_url' => 'https://www.baidu.com',
              'status'       => 1,
              'flag'         => 1,
             ],
             [
              'title'        => '新人升级有礼',
              'pic_path'     => 'uploads/jhhy/pic/slide/2020-04-23/8e32e3725252f8b50451631e32e8d88a.png',
              'type'         => 2,
              'redirect_url' => 'https://www.baidu.com',
              'status'       => 1,
              'flag'         => 1,
             ],
             [
              'title'        => '',
              'pic_path'     => 'uploads/jhhy/pic/slide/2020-04-23/f633ae459e72b655971c09a593e9f7e4.png',
              'type'         => 1,
              'redirect_url' => 'promote',
              'status'       => 1,
              'flag'         => 2,
             ],
             [
              'title'        => '',
              'pic_path'     => 'uploads/jhhy/pic/slide/2020-04-23/f633ae459e72b655971c09a593e9f7e4.png',
              'type'         => 1,
              'redirect_url' => 'login',
              'status'       => 1,
              'flag'         => 2,
             ],
             [
              'title'        => '',
              'pic_path'     => 'uploads/jhhy/pic/slide/2020-04-23/f633ae459e72b655971c09a593e9f7e4.png',
              'type'         => 1,
              'redirect_url' => 'register',
              'status'       => 1,
              'flag'         => 2,
             ],
             [
              'title'        => '',
              'pic_path'     => 'uploads/jhhy/pic/slide/2020-04-23/f633ae459e72b655971c09a593e9f7e4.png',
              'type'         => 1,
              'redirect_url' => 'forget-password',
              'status'       => 1,
              'flag'         => 2,
             ],
            ],
        );
    }
}
