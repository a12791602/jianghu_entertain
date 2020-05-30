<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateActivitiesDynSystemsTable
 */
class CreateActivitiesDynSystemsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'activities_dyn_systems',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->string('name', 32)->default(' ')->comment('活动名称');
                $table->string('sign', 32)->default(' ')->comment('活动标记');
                $table->string('title', 32)->nullable()->comment('标题 对应 Class 类');
                $table->integer('type_id')->nullable()->comment('1 Registraion');
                $table->string('model')->nullable()->comment('Model 对应名');
                $table->integer('last_editor_id')->default(0)->comment('最后更新人');
                $table->boolean('status')->default(0)->comment('状态 0 禁用 1 启用');
                $table->timestamps();
            },
        );
        DB::statement("ALTER TABLE `activities_dyn_systems` comment '系统动态活动表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('activities_dyn_systems');
    }
}
