<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateFrontendUsersBlackListsTable
 */
class CreateFrontendUsersBlackListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'frontend_users_black_lists',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->string('platform_sign', 20)->nullable()->default(null)->comment('平台标识');
                $table->string('mobile', 11)->nullable()->default(null)->comment('手机号码');
                $table->string('uid', 10)->nullable()->default(null)->comment('用户UID');
                $table->decimal('account', 18, 4)->nullable()->default(null)->comment('当前余额');
                $table->timestamp('last_login_time')->nullable()->default(null)->comment('最后登录时间');
                $table->timestamp('register_time')->nullable()->default(null)->comment('注册时间');
                $table->string('last_login_ip', 15)->nullable()->default(null)->comment('最后登录IP');
                $table->string('remark')->nullable()->default(null)->comment('备注');
                $table->timestamp('remove_time')->nullable()->default(null);
                $table->tinyInteger('status')->default(0)->comment('0黑名单状态 1已洗白状态');
                $table->timestamps();
            },
        );
        DB::statement("ALTER TABLE `frontend_users_black_lists` comment '用户黑名单'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('frontend_users_black_lists');
    }
}
