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
                    'title' => '无限极代理',
                    'pic_path' => 'uploads/test/slides/2020-01-08/5d446820bdac52ae0c6c4948b6c79a23.png',
                    'type' => 1,
                    'redirect_url' => 'promote',
                    'status' => 1,
                    'flag' => 1,
                ],
                [
                    'title' => '不定时幸运',
                    'pic_path' => 'uploads/test/slides/2020-01-09/6e99f27b02c88c913e64d799f7891c2d.png',
                    'type' => 1,
                    'redirect_url' => 'promote',
                    'status' => 1,
                    'flag' => 1,
                ],
                [
                    'title' => '未赌先赢',
                    'pic_path' => 'uploads/test/slides/2020-01-08/f01db873b8e9fafcd77b9a1ed802c02f.png',
                    'type' => 2,
                    'redirect_url' => 'https://www.baidu.com',
                    'status' => 1,
                    'flag' => 1,
                ],
                [
                    'title' => '新人升级有礼',
                    'pic_path' => 'uploads/test/slides/2020-01-08/fb45df5a9607c475981310d56fda5f2a.png',
                    'type' => 2,
                    'redirect_url' => 'https://www.baidu.com',
                    'status' => 1,
                    'flag' => 1,
                ],
                [
                    'title' => '',
                    'pic_path' => 'uploads/test/slides/2020-01-08/5d446820bdac52ae0c6c4948b6c79a23.png',
                    'type' => 1,
                    'redirect_url' => 'promote',
                    'status' => 1,
                    'flag' => 2,
                ],
                [
                    'title' => '',
                    'pic_path' => 'uploads/test/slides/2020-01-08/5d446820bdac52ae0c6c4948b6c79a23.png',
                    'type' => 1,
                    'redirect_url' => 'login',
                    'status' => 1,
                    'flag' => 2,
                ],
                [
                    'title' => '',
                    'pic_path' => 'uploads/test/slides/2020-01-08/5d446820bdac52ae0c6c4948b6c79a23.png',
                    'type' => 1,
                    'redirect_url' => 'register',
                    'status' => 1,
                    'flag' => 2,
                ],
                [
                    'title' => '',
                    'pic_path' => 'uploads/test/slides/2020-01-08/5d446820bdac52ae0c6c4948b6c79a23.png',
                    'type' => 1,
                    'redirect_url' => 'forget-password',
                    'status' => 1,
                    'flag' => 2,
                ],
            ],
        );
    }
}
