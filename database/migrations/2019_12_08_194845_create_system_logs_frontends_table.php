<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateSystemLogsFrontendTable
 */
class CreateSystemLogsFrontendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'system_logs_frontends',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->string('log_uuid', 45)->nullable()->default(null)->comment('唯一标识');
                $table->text('description')->nullable()->default(null)->comment('描述');
                $table->string('origin', 200)->nullable()->default(null)->comment('起源');
                $table->enum('type', ['log', 'store', 'change', 'delete'])->comment('类型');
                $table->enum('result', ['success', 'neutral', 'failure'])->comment('结果');
                $table->enum('level', ['emergency', 'alert', 'critical', 'error', 'warning', 'notice', 'info', 'debug'])
                    ->comment('等级');
                $table->string('token', 100)->nullable()->default(null)->comment('token');
                $table->string('ip', 45)->nullable()->default(null)->comment('IP地址');
                $table->string('ips', 200)->nullable()->default(null)->comment('IP地址');
                $table->integer('user_id')->nullable()->default(null)->comment('用户id');
                $table->string('session', 100)->nullable()->default(null);
                $table->string('lang', 50)->nullable()->default(null);
                $table->string('device', 20)->nullable()->default(null)->comment('设备');
                $table->string('os', 20)->nullable()->default(null)->comment('系统');
                $table->string('os_version', 50)->nullable()->default(null)->comment('系统版本');
                $table->string('browser', 50)->nullable()->default(null)->comment('浏览器');
                $table->string('bs_version', 50)->nullable()->default(null)->comment('浏览器版本');
                $table->tinyInteger('device_type')->nullable()->default(null)->comment('设备类型');
                $table->string('robot', 50)->nullable()->default(null)->comment('机器');
                $table->string('user_agent', 200)->nullable()->default(null)->comment('代理');
                $table->text('inputs')->nullable()->default(null)->comment('传递的参数');
                $table->text('route')->nullable()->default(null)->comment('路由');
                $table->unsignedInteger('route_id')->nullable()->default(null)->comment('路由id');
                $table->integer('admin_id')->nullable()->default(null)->comment('管理员id');
                $table->string('admin_name', 64)->nullable()->default(null)->comment('管理员名称');
                $table->string('username', 64)->nullable()->default(null)->comment('用户名');
                $table->integer('menu_id')->nullable()->default(null)->comment('菜单id');
                $table->string('menu_label', 64)->nullable()->default(null)->comment('菜单标题');
                $table->text('menu_path')->nullable()->default(null)->comment('菜单路径');
                $table->nullableTimestamps();
            },
        );
        DB::statement("ALTER TABLE `system_logs_frontends` comment '前台操作日志'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('system_logs_frontends');
    }
}
