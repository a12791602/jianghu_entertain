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
             ['pic_path' => 'uploads/JHHY/avatar/2020-03-25/1c2aceaea46e637be0cad581028defd2.jpg'],
             ['pic_path' => 'uploads/JHHY/avatar/2020-03-25/80d7a0c5182a389519b3f13466cabd82.jpg'],
             ['pic_path' => 'uploads/JHHY/avatar/2020-03-25/85aab7699c4b3d725390debd8168bcd3.jpg'],
             ['pic_path' => 'uploads/JHHY/avatar/2020-03-25/b648c61dd2b7fbb8c4703d90d642e7e8.jpg'],
             ['pic_path' => 'uploads/JHHY/avatar/2020-03-25/cd0512c5461a170035977c8334f7e6b4.jpg'],
             ['pic_path' => 'uploads/JHHY/avatar/2020-03-25/f9f8a45512b1dc4fb05a8d5e4a3e9a73.jpg'],
             ['pic_path' => 'uploads/JHHY/avatar/2020-03-25/0a2d5a4be960afd4d0f624500a611b09.jpg'],
             ['pic_path' => 'uploads/JHHY/avatar/2020-03-25/1939c2c1f4c235984a9bd4a5b38fcc1a.jpg'],
             ['pic_path' => 'uploads/JHHY/avatar/2020-03-25/2b9df028ecef1e782b9dd2a1bef7f80a.jpg'],
             ['pic_path' => 'uploads/JHHY/avatar/2020-03-25/b68db717c0dd9303da1fb1b9f7b58dde.jpg'],
             ['pic_path' => 'uploads/JHHY/avatar/2020-03-25/4ad0e98f3aa7198eb4fb6bc99cc85a55.jpg'],
             ['pic_path' => 'uploads/JHHY/avatar/2020-03-25/c451315a1e53c05262966524fd903055.jpg'],
             ['pic_path' => 'uploads/JHHY/avatar/2020-03-25/b18f34d1064beea0e76b3f9fed5acc02.jpg'],
             ['pic_path' => 'uploads/JHHY/avatar/2020-03-25/287cd7c16c04c81f9011213fb6f6001d.jpg'],
             ['pic_path' => 'uploads/JHHY/avatar/2020-03-25/f335fcd9c26d8588594ec95593753381.jpg'],
             ['pic_path' => 'uploads/JHHY/avatar/2020-03-25/6534d5fa15bac70fe286ba00808a537a.jpg'],
            ],
        );
    }
}
