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
              'parent_id'      => 1,
              'name'           => '扑克',
              'sign'           => 'poker',
              'status'         => 1,
              'author_id'      => 0,
              'last_editor_id' => 0,
              'sort'           => 1,
             ],
             [
              'parent_id'      => 1,
              'name'           => '牛牛',
              'sign'           => 'bull',
              'status'         => 1,
              'author_id'      => 0,
              'last_editor_id' => 0,
              'sort'           => 2,
             ],
             [
              'parent_id'      => 1,
              'name'           => '麻将',
              'sign'           => 'mah-jong',
              'status'         => 1,
              'author_id'      => 0,
              'last_editor_id' => 0,
              'sort'           => 3,
             ],
             [
              'parent_id'      => 5,
              'name'           => 'VR游戏',
              'sign'           => 'vr-game',
              'status'         => 1,
              'author_id'      => 0,
              'last_editor_id' => 0,
              'sort'           => 3,
             ],
             [
              'parent_id'      => 1,
              'name'           => '其他',
              'sign'           => 'other',
              'status'         => 1,
              'author_id'      => 0,
              'last_editor_id' => 0,
              'sort'           => 4,
             ],
             [
              'parent_id'      => 2,
              'name'           => '其他',
              'sign'           => 'other',
              'status'         => 1,
              'author_id'      => 0,
              'last_editor_id' => 0,
              'sort'           => 5,
             ],
            ],
        );
    }
}
