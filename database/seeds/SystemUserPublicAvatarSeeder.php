<?php

use App\Models\Systems\SystemUserPublicAvatar;
use Illuminate\Database\Seeder;

/**
 * Class SystemUserPublicAvatarSeeder
 */
class SystemUserPublicAvatarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        SystemUserPublicAvatar::insert(
            [
             ['pic_path' => 'uploads/test/avatar/2020-02-25/7c0a218b4f651a9c6aeded81fc032ef6.png'],
             ['pic_path' => 'uploads/jhhy/avatar/2020-02-25/cc416c9a04bd669f21015b9a3a3be81a.jpg'],
             ['pic_path' => 'uploads/jhhy/avatar/2020-02-25/91945f0098a9d3c9211027c6ef7c239c.jpg'],
             ['pic_path' => 'uploads/jhhy/avatar/2020-02-25/c816334aa5429fd5ef44c064dbf9c393.jpg'],
             ['pic_path' => 'uploads/jhhy/avatar/2020-02-25/709aa5bf32f9cd1e4be15d921079f916.jpg'],
             ['pic_path' => 'uploads/jhhy/avatar/2020-02-25/55bdd6ac360b6728587c8a734cee8d2c.jpg'],
             ['pic_path' => 'uploads/jhhy/avatar/2020-02-25/3882540f56da079894d0d3216db3a6ef.jpg'],
             ['pic_path' => 'uploads/jhhy/avatar/2020-02-25/8c4278b36bdc539f862254479b79df64.jpg'],
             ['pic_path' => 'uploads/jhhy/avatar/2020-02-25/3f5b2f8ed15e09086e0a77e98d473475.jpg'],
             ['pic_path' => 'uploads/jhhy/avatar/2020-02-25/2f2809365646c1f57664cccc5e6f8406.jpg'],
             ['pic_path' => 'uploads/jhhy/avatar/2020-02-25/5e2308ce7471451bc006ce32431797c8.jpg'],
            ],
        );
    }
}
