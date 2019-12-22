<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateUsersLogoutLogsTable
 */
class CreateUsersLogoutLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'users_logout_logs',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->string('platform_sign', 32)->nullable()->default(null)->comment('平台标识');
                $table->integer('user_id')->nullable()->default(null)->comment('用户id');
                $table->integer('last_login_id')->nullable()->default(null)->comment('最后一次登录id');
                $table->timestamp('logout_time')->nullable()->default(null)->comment('退出登录时间');
                $table->integer('online_time')->nullable()->default(null)->comment('在线时长 单位秒');
                $table->nullableTimestamps();
            },
        );
        DB::statement("ALTER TABLE `users_logout_logs` comment '用户退出登录日志表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('users_logout_logs');
    }
}
