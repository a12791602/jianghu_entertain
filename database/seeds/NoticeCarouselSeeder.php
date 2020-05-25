<?php

use App\Models\Notice\NoticeCarousel;
use Illuminate\Database\Seeder;

/**
 * Class NoticeCarouselSeeder
 */
class NoticeCarouselSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        NoticeCarousel::insert(
            [
             [
              'id'             => 1,
              'platform_id'    => 1,
              'title'          => '无线级代理模式',
              'pic_id'         => 149,
              'type'           => 1,
              'link'           => '/tmp/activity1',
              'start_time'     => '2020-05-18 00:00:00',
              'end_time'       => '2020-06-30 00:00:00',
              'status'         => 1,
              'author_id'      => 1,
              'last_editor_id' => 1,
              'device'         => 2,
              'created_at'     => '2020-05-17 20:16:35',
              'updated_at'     => '2020-05-25 21:15:54',
             ],
             [
              'id'             => 2,
              'platform_id'    => 1,
              'title'          => '红包好礼',
              'pic_id'         => 150,
              'type'           => 1,
              'link'           => '/tmp/activity2',
              'start_time'     => '2020-05-18 00:00:00',
              'end_time'       => '2020-06-30 00:00:00',
              'status'         => 1,
              'author_id'      => 1,
              'last_editor_id' => 1,
              'device'         => 2,
              'created_at'     => '2020-05-17 20:17:37',
              'updated_at'     => '2020-05-25 21:16:03',
             ],
             [
              'id'             => 3,
              'platform_id'    => 1,
              'title'          => '注册送礼',
              'pic_id'         => 151,
              'type'           => 1,
              'link'           => '/tmp/activity3',
              'start_time'     => '2020-05-18 00:00:00',
              'end_time'       => '2020-06-30 00:00:00',
              'status'         => 1,
              'author_id'      => 1,
              'last_editor_id' => 1,
              'device'         => 2,
              'created_at'     => '2020-05-17 20:19:01',
              'updated_at'     => '2020-05-25 21:16:12',
             ],
             [
              'id'             => 4,
              'platform_id'    => 1,
              'title'          => '新人晋级有礼',
              'pic_id'         => 152,
              'type'           => 1,
              'link'           => '/tmp/activity4',
              'start_time'     => '2020-05-18 00:00:00',
              'end_time'       => '2020-06-30 00:00:00',
              'status'         => 1,
              'author_id'      => 1,
              'last_editor_id' => 1,
              'device'         => 2,
              'created_at'     => '2020-05-17 20:20:21',
              'updated_at'     => '2020-05-25 21:16:20',
             ],
            ],
        );
    }
}
