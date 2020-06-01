<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

/**
 * Class CreateActivitiesConfigRegRandomTable
 */
class CreateActivitiesConfigRegRandomTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'activities_config_reg_firstime_randoms',
            static function (Blueprint $table): void {
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->increments('id');
                $table->decimal('item', 6)->nullable()->comment('礼物金额');
                $table->decimal('probability', 5)->nullable()->comment('礼物抽中概率');
                $table->timestamps();
            },
            );
        DB::statement("ALTER TABLE `activities_config_reg_firstime_randoms` comment '注册送礼活动配置奖品表'");
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::drop('activities_config_reg_random');
    }
}
