<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateSystemDynActivitiesTable
 */
class CreateSystemDynActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'system_dyn_activities',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->string('name', 32)->default(' ')->comment('活动名称');
                $table->string('sign', 32)->default(' ')->comment('活动标记');
                $table->integer('last_editor_id')->default(0)->comment('最后更新人');
                $table->tinyInteger('status')->default(0)->comment('状态 0 禁用 1 启用');
                $table->timestamp('created_at')->useCurrent();
                $table->timestamp('updated_at')->useCurrent();
            },
        );
        DB::statement("ALTER TABLE `system_dyn_activities` comment '系统动态活动表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('system_dyn_activities');
    }
}
