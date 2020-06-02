<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class CreateActivitiesDynPlatformsTable
 */
class CreateActivitiesDynPlatformsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'activities_dyn_platforms',
            static function (Blueprint $table): void {
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->increments('id');
                $table->integer('activity_dyn_id')->comment('动态活动Id');
                $table->integer('platform_id')->comment('平台id');
                $table->boolean('status')->nullable()->default(0)->comment('启用状态0关闭1启用');
                $table->timestamps();
            },
            );
        DB::statement("ALTER TABLE `activities_dyn_platforms` comment '活动平台关联表'");
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::drop('activities_dyn_platforms');
    }
}
