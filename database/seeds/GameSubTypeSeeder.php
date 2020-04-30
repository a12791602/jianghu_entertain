<?php

use App\Models\Game\GameSubType;
use Illuminate\Database\Seeder;

/**
 * Class GameSubTypeSeeder
 */
class GameSubTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        GameSubType::insert(
            [
             [
              'id'             => 1,
              'parent_id'      => 1,
              'name'           => '扑克',
              'sign'           => 'poker',
              'status'         => 1,
              'author_id'      => 0,
              'last_editor_id' => 0,
              'sort'           => 1,
             ],
             [
              'id'             => 2,
              'parent_id'      => 1,
              'name'           => '牛牛',
              'sign'           => 'bull',
              'status'         => 1,
              'author_id'      => 0,
              'last_editor_id' => 0,
              'sort'           => 2,
             ],
             [
              'id'             => 3,
              'parent_id'      => 1,
              'name'           => '麻将',
              'sign'           => 'mah-jong',
              'status'         => 1,
              'author_id'      => 0,
              'last_editor_id' => 0,
              'sort'           => 3,
             ],
             [
              'id'             => 4,
              'parent_id'      => 1,
              'name'           => '其他',
              'sign'           => 'other',
              'status'         => 1,
              'author_id'      => 0,
              'last_editor_id' => 0,
              'sort'           => 4,
             ],
             [
              'id'             => 5,
              'parent_id'      => 3,
              'name'           => '捕鱼',
              'sign'           => 'fishing',
              'status'         => 1,
              'author_id'      => 0,
              'last_editor_id' => 0,
              'sort'           => 5,
             ],
             [
              'id'             => 6,
              'parent_id'      => 4,
              'name'           => '电子游戏',
              'sign'           => 'e-game',
              'status'         => 1,
              'author_id'      => 0,
              'last_editor_id' => 0,
              'sort'           => 6,
             ],
             [
              'id'             => 7,
              'parent_id'      => 5,
              'name'           => 'VR游戏',
              'sign'           => 'vr-game',
              'status'         => 1,
              'author_id'      => 0,
              'last_editor_id' => 0,
              'sort'           => 7,
             ],
             [
              'id'             => 8,
              'parent_id'      => 5,
              'name'           => 'VR动画彩',
              'sign'           => 'vr-animation',
              'status'         => 1,
              'author_id'      => 0,
              'last_editor_id' => 0,
              'sort'           => 8,
             ],
             [
              'id'             => 9,
              'parent_id'      => 5,
              'name'           => 'VR视讯彩',
              'sign'           => 'vr-video',
              'status'         => 1,
              'author_id'      => 0,
              'last_editor_id' => 0,
              'sort'           => 9,
             ],
             [
              'id'             => 10,
              'parent_id'      => 5,
              'name'           => 'VR自开高频彩',
              'sign'           => 'vr-lottery',
              'status'         => 1,
              'author_id'      => 0,
              'last_editor_id' => 0,
              'sort'           => 10,
             ],
             [
              'id'             => 11,
              'parent_id'      => 6,
              'name'           => '彩票',
              'sign'           => 'lottery',
              'status'         => 1,
              'author_id'      => 0,
              'last_editor_id' => 0,
              'sort'           => 11,
             ],
             [
              'id'             => 12,
              'parent_id'      => 1,
              'name'           => '游戏大厅',
              'sign'           => 'lobby',
              'status'         => 1,
              'author_id'      => 0,
              'last_editor_id' => 0,
              'sort'           => 12,
             ],
             [
              'id'             => 13,
              'parent_id'      => 2,
              'name'           => '游戏大厅',
              'sign'           => 'sport-lobby',
              'status'         => 1,
              'author_id'      => 0,
              'last_editor_id' => 0,
              'sort'           => 13,
             ],
            ],
        );
    }
}
