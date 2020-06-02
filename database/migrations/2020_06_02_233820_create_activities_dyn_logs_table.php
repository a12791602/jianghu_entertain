<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class CreateActivitiesDynLogsTable
 */
class CreateActivitiesDynLogsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'activities_dyn_logs',
            static function (Blueprint $table): void {
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->increments('id');
                $table->integer('user_id')->comment('用户id')->index();
                $table->integer('activity_dyn_id')->comment('动态活动id')->index();
                $table->string('item', 35)->nullable()->comment('奖品种类')->index();
                $table->decimal('amount', 6)->nullable()->comment('中将金额');
                $table->timestamps();
            },
            );
        DB::statement("ALTER TABLE `activities_dyn_logs` comment '活动抽奖日志'");
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::drop('activities_dyn_logs');
    }
}
