<?php

use App\Models\Admin\BackendAdminUser;
use Illuminate\Database\Seeder;

/**
 * Class BackendAdminUserSeeder
 */
class BackendAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        BackendAdminUser::insert(
            [
                [
                    'name' => 'Harris',
                    'email' => 'harrisdt15f@gmail.com',
                    'password' => '$2y$10$Bz7/W8LEMgHnOkAtULbpbOjpjESkTihGyGJLJUsPGYquBJCP8bQfm',
                    'is_test' => 0,
                    'group_id' => 1,
                    'status' => 1,
                ],
                [
                    'name' => 'Ling',
                    'email' => 'Ling@gmail.com',
                    'password' => '$2y$10$XaPvMsUOCZFxm6uTAqkOUuCJP/hPlUV.BN.Wf0Cps6qShpt1AfoRi',
                    'is_test' => 1,
                    'group_id' => 1,
                    'status' => 1,
                ],
            ],
        );
    }
}
