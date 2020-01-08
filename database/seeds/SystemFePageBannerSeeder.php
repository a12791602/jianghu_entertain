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
                    'content' => '无限极代理,无限极代理',
                    'pic_path' => 'uploads/test/slides/2020-01-08/5d446820bdac52ae0c6c4948b6c79a23.png',
                    'type' => 2,
                    'redirect_url' => 'h5.jianghu.local/',
                    'status' => 1,
                    'flag' => 2,
                ],
                [
                    'title' => '新人升级有礼',
                    'content' => '新人升级有礼,新人升级有礼',
                    'pic_path' => 'uploads/test/slides/2020-01-08/fb45df5a9607c475981310d56fda5f2a.png',
                    'type' => 1,
                    'redirect_url' => '',
                    'status' => 1,
                    'flag' => 2,
                ],
                [
                    'title' => '未赌先赢',
                    'content' => '',
                    'pic_path' => 'uploads/test/slides/2020-01-08/f01db873b8e9fafcd77b9a1ed802c02f.png',
                    'type' => 1,
                    'redirect_url' => 'h5.jianghu.local/',
                    'status' => 1,
                    'flag' => 2,
                ],
            ],
        );
    }
}
