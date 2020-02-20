<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateSystemDynActivityPlatformsTable
 */
class CreateSystemDynActivityPlatformsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'system_dyn_activity_platforms',
            static function (Blueprint $table): void {
                $table->bigIncrements('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->string('platform_sign')->default(' ')->comment('平台标记');
                $table->string('activity_sign')->default(' ')->comment('活动标记');
                $table->tinyInteger('status')->default(0)->comment('状态  0.关闭 1.开启');
                $table->string('pc_pic')->default(' ')->comment('pc端图片');
                $table->string('h5_pic')->default(' ')->comment('h5端图片');
                $table->string('app_pic')->default(' ')->comment('app端图片');
                $table->integer('last_editor_id')->default(0)->comment('最后修改的管理员id');
                $table->timestamp('start_time')->useCurrent()->comment('开始时间');
                $table->timestamp('end_time')->useCurrent()->comment('结束时间');
                $table->timestamps();
            },
        );
        DB::statement("ALTER TABLE `system_dyn_activity_platforms` comment '动态活动与平台关联表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('system_dyn_activity_platforms');
    }
}
