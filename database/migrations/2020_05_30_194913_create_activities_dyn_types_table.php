<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class CreateActivitiesDynTypesTable
 */
class CreateActivitiesDynTypesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'activities_dyn_types',
            static function (Blueprint $table): void {
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->increments('id');
                $table->string('type_name', 32)->nullable()->comment('活动类型');
                $table->string('type_title', 32)->nullable()->comment('活动类型标题');
                $table->timestamps();
            },
            );
        DB::statement("ALTER TABLE `activities_dyn_types` comment '系统动态活动表类型'");
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::drop('activities_dyn_types');
    }
}
