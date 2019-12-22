<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateUsersLoginGameLogsTable
 */
class CreateUsersLoginGameLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'users_login_game_logs',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->string('platform_sign', 32)->nullable()->default(null)->comment('平台标识');
                $table->integer('user_id')->nullable()->default(null)->comment('用户id');
                $table->integer('game_vendor_id')->nullable()->default(null)->comment('游戏厂商id');
                $table->integer('game_id')->nullable()->default(null)->comment('游戏id');
                $table->string('login_ip', 16)->nullable()->default(null)->comment('IP');
                $table->nullableTimestamps();
            },
        );
        DB::statement("ALTER TABLE `users_login_game_logs` comment '用户登陆游戏记录'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('users_login_game_logs');
    }
}
