<?php

use App\Models\User\FrontendUser;
use Illuminate\Database\Seeder;

/**
 * Class FrontendUserSeeder
 */
class FrontendUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        FrontendUser::insert(
            [
                [
                    'uid' => 189673,
                    'username' => 'harriszhongdai',
                    'mobile' => 13880628809,
                    'top_id' => 0,
                    'parent_id' => 0,
                    'platform_id' => 1,
                    'platform_sign' => 'test',
                    'account_id' => 1,
                    'type' => 2,
                    'grade_id' => 0,
                    'is_tester' => 0,
                    'password' => '$2y$10$NiD/0SJjZP.FGEbILMizPOBKIAY4VOzwMa9HZdd8xQ4.TNlTlACTq',
                    'fund_password' => '$2y$10$71x11gceU8LOzZbQA47F4OojCJfv2Y3GO3E8rf9rKJQFfSvWXqnFW',
                    'security_code' => '',
                    'level_deep' => 0,
                    'user_specific_id' => 1,
                    'status' => 1,
                    'user_tag_id' => 4,
                    'invite_code' => 123456,
                    'pic_path' => '/avatar.png',
                ],
                [
                    'uid' => 189674,
                    'username' => 'ling1',
                    'mobile' => 18844446666,
                    'top_id' => 0,
                    'parent_id' => 0,
                    'platform_id' => 1,
                    'platform_sign' => 'test',
                    'account_id' => 2,
                    'type' => 2,
                    'grade_id' => 0,
                    'is_tester' => 0,
                    'password' => '$2y$10$gNYXCLhuwCnb3wIE.JgCx.X2nrbEZejM9GE3IXUQPFsfRsFMYH/u2',
                    'fund_password' => '$2y$10$hpKv1170O8O9yVFuSUPAMOTLOgQq2B.ll1FR1G99ip0cTU8yPld36',
                    'security_code' => '$2y$10$s/RXnjI0cU0f/ninzV0i2eO3U3Uegb1Xo4Sja0T.HuQoUajWZaz7i',
                    'level_deep' => 0,
                    'user_specific_id' => 2,
                    'status' => 1,
                    'user_tag_id' => 4,
                    'invite_code' => 123456,
                    'pic_path' => 'uploads/test/avatar/2020-01-08/7c0a218b4f651a9c6aeded81fc032ef6.png',
                ],
            ],
        );
    }
}
