<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateUsersLoginLogsTable
 */
class CreateUsersLoginLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'users_login_logs',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->integer('pid')->comment('父类id, 顶级为0');
                $table->string('platform_sign', 10)->nullable()->default(null)->comment('平台标识');
                $table->string('mobile', 11)->nullable()->default(null)->comment('用户手机号码');
                $table->string('guid', 16)->nullable()->default(null)->comment('用户UID');
                $table->text('origin', 65535)->nullable()->comment('登录地址');
                $table->timestamp('last_login_time')->nullable()->default(null)->comment('最后登陆时间');
                $table->string('last_login_ip', 15)->nullable()->default(null)->comment('最后登陆IP');
                $table->string('last_login_device', 32)->nullable()->default(null)->comment('最后登陆的设备');
                $table->timestamps();
            },
        );
        DB::statement("ALTER TABLE `users_login_logs` comment '用户登录记录'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('users_login_logs');
    }
}
