<?php

use App\Models\DeveloperUsage\Menu\MerchantSystemMenu;
use Illuminate\Database\Seeder;

/**
 * Class MerchantSystemMenuSeeder
 */
class MerchantSystemMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        MerchantSystemMenu::insert(
            [
                [
                    'label' => '新父级菜单',
                    'en_name' => 'bbb.bb',
                    'route' => '#',
                    'pid' => 0,
                    'display' => 1,
                    'level' => 0,
                    'sort' => 0,
                    'type' => 0,
                ],
                [
                    'label' => 'test3',
                    'en_name' => 'test3',
                    'route' => '',
                    'pid' => 2,
                    'display' => 0,
                    'level' => 0,
                    'sort' => 1,
                    'type' => 0,
                ],
                [
                    'label' => '测试3',
                    'en_name' => 'testq',
                    'route' => '/test/test',
                    'pid' => 0,
                    'display' => 1,
                    'level' => 0,
                    'sort' => 50,
                    'type' => 0,
                ],
                [
                    'label' => '测试5',
                    'en_name' => 'testz',
                    'route' => '/test/test',
                    'pid' => 2,
                    'display' => 1,
                    'level' => 2,
                    'sort' => 50,
                    'type' => 0,
                ],
                [
                    'label' => '测试7',
                    'en_name' => 'testx',
                    'route' => '/test/test',
                    'pid' => 2,
                    'display' => 1,
                    'level' => 2,
                    'sort' => 50,
                    'type' => 0,
                ],
                [
                    'label' => '测试4',
                    'en_name' => 'testk',
                    'route' => '/test/test',
                    'pid' => 2,
                    'display' => 1,
                    'level' => 2,
                    'sort' => 50,
                    'type' => 0,
                ],
            ],
        );
    }
}
