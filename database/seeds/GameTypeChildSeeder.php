<?php

use App\Models\Game\GameTypeChild;
use Illuminate\Database\Seeder;

/**
 * Class GameTypeChildSeeder
 */
class GameTypeChildSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        GameTypeChild::insert(
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
