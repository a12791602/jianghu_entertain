<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateSystemUsersHelpCentersTable
 */
class CreateSystemUsersHelpCentersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'system_users_help_centers',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->string('platform_sign', 10)->nullable()->default(null)->comment('平台标识');
                $table->integer('pid')->nullable()->default(0)->comment('上级ID');
                $table->string('title', 32)->nullable()->default(null)->comment('标题');
                $table->string('pic', 128)->nullable()->default(null)->comment('图片路径');
                $table->tinyInteger('type')->nullable()->default(null)->comment('1. H5  2. PC  3. APP');
                $table->tinyInteger('status')->default(0)->comment('开启状态 0关闭 1开启');
                $table->integer('add_admin_id')->nullable()->default(null)->comment('添加的管理员id');
                $table->integer('update_admin_id')->nullable()->default(null)->comment('最后修改的管理员id');
                $table->index('title');
                $table->index('status');
                $table->nullableTimestamps();
            },
        );
        DB::statement("ALTER TABLE `system_users_help_centers` comment '前台帮助中心'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('system_users_help_centers');
    }
}
