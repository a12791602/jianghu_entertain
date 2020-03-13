<?php

use App\Models\Systems\SystemPlatformSkin;
use Illuminate\Database\Seeder;

/**
 * Class SystemPlatformSkinSeeder
 */
class SystemPlatformSkinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        SystemPlatformSkin::insert(
            [
             [
              'name' => '默认皮肤',
              'sign' => 'pc-default',
              'type' => 1,
             ],
             [
              'name' => '默认皮肤',
              'sign' => 'h5-default',
              'type' => 2,
             ],
             [
              'name' => '默认皮肤',
              'sign' => 'app-default',
              'type' => 3,
             ],
            ],
        );
    }
}
