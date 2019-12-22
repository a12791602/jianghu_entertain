<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateSystemUsersHelpCentersFeTable
 */
class CreateSystemUsersHelpCentersFeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'system_users_help_centers_fe',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->integer('pid')->comment('上级id');
                $table->string('title', 128)->nullable()->default(null)->comment('标题');
                $table->text('content')->nullable()->default(null)->comment('内容');
                $table->tinyInteger('status')->default('0')->comment('开启状态 0关闭 1开启');
                $table->nullableTimestamps();
            },
        );
        DB::statement("ALTER TABLE `system_users_help_centers_fe` comment '前台帮助中心'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('system_users_help_centers_fe');
    }
}
