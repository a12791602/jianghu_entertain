<?php

use App\Models\Notice\NoticeMarquee;
use Illuminate\Database\Seeder;

/**
 * Class NoticeMarqueeSeeder
 */
class NoticeMarqueeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        NoticeMarquee::insert(
            [
             [
              'id'             => 1,
              'platform_id'    => 1,
              'title'          => '[通知] 申博真人已下线！',
              'content'        => '很抱歉的通知您，申博真人官方宣布因全球性疫情原因已于2020年5月15日关闭游戏入口，请申博玩家在2020年5月21日之前，将账户中的申博额度转出至平台，给您带来的不便，敬请谅解！如有任何疑问，请您咨询在线客服，我们将竭诚为您服务。 始善于诚 · 至臻于勤 ',
              'device'         => '[1, 2]',
              'status'         => 1,
              'start_time'     => '2019-01-01 00:00:00',
              'end_time'       => '2020-01-02 00:00:00',
              'author_id'      => 1,
              'last_editor_id' => 2,
              'created_at'     => '2020-05-18 20:52:37',
              'updated_at'     => '2020-05-18 21:08:08',
             ],
            ],
        );
    }
}
