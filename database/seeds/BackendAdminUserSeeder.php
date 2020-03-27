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
              'name'     => 'Harris',
              'email'    => 'harrisdt15f@gmail.com',
              'password' => '$2y$10$Z1XyP6L7AclsM3sG6KxRhOtqHmLi2cyhbrKiNmJjK7rBjlv.rWCEe',
              'is_test'  => 0,
              'group_id' => 1,
              'status'   => 1,
             ],
             [
              'name'     => 'Ling',
              'email'    => 'Ling@gmail.com',
              'password' => '$2y$10$Z1XyP6L7AclsM3sG6KxRhOtqHmLi2cyhbrKiNmJjK7rBjlv.rWCEe',
              'is_test'  => 1,
              'group_id' => 1,
              'status'   => 1,
             ],
             [
              'name'     => 'aaron',
              'email'    => 'aaron@qq.com',
              'password' => '$2y$10$FfNqefi/YF9OqR2IthMzKOqPOVxfA10JzC/qnqZ3PjpdC.fs5dZQO',
              'is_test'  => 1,
              'group_id' => 1,
              'status'   => 1,
             ],
            ],
        );
    }
}
