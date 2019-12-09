<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesPlatformsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games_platforms', function (Blueprint $table) {
            $table->increments('id');
            $table->collation = 'utf8mb4_0900_ai_ci';
            $table->string('platform_sign', 32)->nullable()->default(null)->comment('平台标识');
            $table->string('game_sign', 32)->nullable()->default(null)->comment('游戏标记');
            $table->tinyInteger('status')->nullable()->default(null)->comment('状态 1 启用 0 禁用');
            $table->integer('sort')->nullable()->default(null)->comment('排序');
            $table->tinyInteger('is_hot')->nullable()->default(null)->comment('是否热门 1 是 0 否');
            $table->nullableTimestamps();
        });
        \Illuminate\Support\Facades\DB::statement("ALTER TABLE `games_platforms` comment '游戏与平台关联表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('games_platforms');
    }
}