<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateFrontendUsersSpecificInfosTable
 */
class CreateFrontendUsersSpecificInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'frontend_users_specific_infos',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->integer('user_id')->comment('用户id');
                $table->tinyInteger('level')->nullable()->default(0)->comment('vip等级');
                $table->string('nickname', 16)->nullable()->default(null)->comment('昵称');
                $table->integer('experience')->default(0)->comment('经验值');
                $table->tinyInteger('avatar')->nullable()->default(null)->comment('头像ID');
                $table->string('email', 128)->nullable()->default(null)->comment('邮箱');
                $table->string('zip_code', 6)->nullable()->default(null)->comment('邮编');
                $table->string('address', 128)->nullable()->default(null)->comment('地址');
                $table->tinyInteger('register_type')->default('0')
                    ->comment('注册类型：0.普通注册1.人工开户注册2.链接开户注册3.扫码开户注册');
                $table->integer('total_members')->nullable()->default('0')->comment('用户发展客户总数');
                $table->string('domain')->nullable()->default(null)->comment('所属域名');
                $table->json('g_active')->nullable()->comment('游戏已被注册判断字段 绑定的是厂商表的sign值为1,0,默认1');
                $table->timestamps();
            },
        );
        DB::statement("ALTER TABLE `frontend_users_specific_infos` comment '用户信息拓展表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('frontend_users_specific_infos');
    }
}
