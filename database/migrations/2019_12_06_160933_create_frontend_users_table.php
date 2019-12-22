<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateFrontendUsersTable
 */
class CreateFrontendUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'frontend_users',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->string('username', 64)->nullable()->default(null)->comment('用户名');
                $table->string('mobile', 11)->nullable()->default(null)->comment('手机号码');
                $table->string('uid', 10)->nullable()->default(null)->comment('用户唯一标识UID');
                $table->integer('top_id')->nullable()->default('0')->comment('最上级id');
                $table->integer('parent_id')->nullable()->default('0')->comment('上级id');
                $table->integer('platform_id')->nullable()->default(null)->comment('平台id');
                $table->string('platform_sign', 32)->nullable()->default(null)->comment('平台标识');
                $table->integer('account_id')->nullable()->default(null)->comment('account表id');
                $table->tinyInteger('type')->default('3')->comment('用户类型:1会员 2代理');
                $table->integer('vip_level_id')->nullable()->default('0')->comment('vip等级id');
                $table->tinyInteger('is_tester')->nullable()->default('0')->comment('是否测试用户 0否 1是');
                $table->string('password', 64)->nullable()->default(null)->comment('密码');
                $table->string('fund_password', 64)->nullable()->default(null)->comment('资金密码');
                $table->text('remember_token')->nullable()->default(null)->comment('token');
                $table->integer('level_deep')->nullable()->default('0')->comment('用户等级深度');
                $table->char('register_ip', 15)->nullable()->default(null)->comment('注册IP');
                $table->char('last_login_ip', 15)->nullable()->default(null)->comment('最后登陆IP');
                $table->timestamp('last_login_time')->nullable()->default(null)->comment('最后登陆时间');
                $table->integer('user_specific_id')->nullable()->default(null)->comment('用户扩展信息表id');
                $table->tinyInteger('status')->default('1')->comment('状态 0禁用 1正常');
                $table->string('pic_path', 128)->nullable()->default(null)->comment('头像路径');
                $table->string('invite_code', 64)->nullable()->default(null)->comment('邀请码');
                $table->tinyInteger('is_online')->nullable()->default(null)->comment('是否在线 1 是 0 否');
                $table->string('device_code', 128)->nullable()->default(null)->comment('设备');
                $table->nullableTimestamps();
            },
        );
        DB::statement("ALTER TABLE `frontend_users` comment '前台用户'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('frontend_users');
    }
}
