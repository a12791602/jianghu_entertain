<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateBackendLoginLogsTable
 */
class CreateBackendLoginLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'backend_login_logs',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->string('name', 64)->nullable()->default(null)->comment('用户名');
                $table->string('email', 64)->nullable()->default(null)->comment('邮箱');
                $table->string('ip', 16)->nullable()->default(null)->comment('IP地址');
                $table->string('ips')->nullable()->default(null);
                $table->tinyInteger('type')->nullable()->default(null)->comment('1.总后台   2.代理后台');

                $table->index('email');
                $table->index('ip');
                $table->index('created_at');

                $table->nullableTimestamps();
            },
        );
        DB::statement("ALTER TABLE `backend_login_logs` comment '登录记录表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('backend_login_logs');
    }
}
