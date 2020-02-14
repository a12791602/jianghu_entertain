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
              'guid'             => 1896731,
              'mobile'           => 13880628809,
              'top_id'           => 0,
              'parent_id'        => 0,
              'platform_id'      => 1,
              'platform_sign'    => 'test',
              'type'             => 2,
              'grade_id'         => 0,
              'is_tester'        => 0,
              'password'         => '$2y$10$NiD/0SJjZP.FGEbILMizPOBKIAY4VOzwMa9HZdd8xQ4.TNlTlACTq',
              'fund_password'    => '$2y$10$3ORT.Xykt2FYuC9VJsM0sueNO0KRIY1c5eAydq6wydV2YOmuGONSW',
              'security_code'    => '',
              'level_deep'       => 0,
              'user_specific_id' => 1,
              'status'           => 1,
              'user_tag_id'      => 4,
              'invite_code'      => null,
             ],
             [
              'guid'             => 1896732,
              'mobile'           => 18844446666,
              'top_id'           => 0,
              'parent_id'        => 0,
              'platform_id'      => 1,
              'platform_sign'    => 'test',
              'type'             => 2,
              'grade_id'         => 0,
              'is_tester'        => 0,
              'password'         => '$2y$10$gNYXCLhuwCnb3wIE.JgCx.X2nrbEZejM9GE3IXUQPFsfRsFMYH/u2',
              'fund_password'    => '$2y$10$3ORT.Xykt2FYuC9VJsM0sueNO0KRIY1c5eAydq6wydV2YOmuGONSW',
              'security_code'    => '$2y$10$s/RXnjI0cU0f/ninzV0i2eO3U3Uegb1Xo4Sja0T.HuQoUajWZaz7i',
              'level_deep'       => 0,
              'user_specific_id' => 2,
              'status'           => 1,
              'user_tag_id'      => 4,
              'invite_code'      => 1896731,
             ],
             [
              'guid'             => 1896733,
              'mobile'           => 18844446666,
              'top_id'           => 0,
              'parent_id'        => 0,
              'platform_id'      => 2,
              'platform_sign'    => 'test_2',
              'type'             => 2,
              'grade_id'         => 0,
              'is_tester'        => 0,
              'password'         => '$2y$10$gNYXCLhuwCnb3wIE.JgCx.X2nrbEZejM9GE3IXUQPFsfRsFMYH/u2',
              'fund_password'    => '$2y$10$3ORT.Xykt2FYuC9VJsM0sueNO0KRIY1c5eAydq6wydV2YOmuGONSW',
              'security_code'    => '$2y$10$s/RXnjI0cU0f/ninzV0i2eO3U3Uegb1Xo4Sja0T.HuQoUajWZaz7i',
              'level_deep'       => 0,
              'user_specific_id' => 2,
              'status'           => 1,
              'user_tag_id'      => 4,
              'invite_code'      => 1234567,
             ],
            ],
        );
    }
}
