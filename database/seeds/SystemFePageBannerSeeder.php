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
                    'pic_path' => 'slides/bannerA.5d44682.png',
                    'type' => 2,
                    'redirect_url' => 'h5.jianghu.local/',
                    'status' => 1,
                    'flag' => 2,
                ],
                [
                    'title' => '新人升级有礼',
                    'content' => '新人升级有礼,新人升级有礼',
                    'pic_path' => 'slides/bannerD.fb45df5.png',
                    'type' => 1,
                    'redirect_url' => '',
                    'status' => 1,
                    'flag' => 2,
                ],
                [
                    'title' => '未赌先赢',
                    'content' => '',
                    'pic_path' => 'slides/bannerC.f01db87.png',
                    'type' => 1,
                    'redirect_url' => 'h5.jianghu.local/',
                    'status' => 1,
                    'flag' => 2,
                ],
            ],
        );
    }
}
