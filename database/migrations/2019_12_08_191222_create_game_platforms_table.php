<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateGamePlatformsTable
 */
class CreateGamePlatformsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'game_platforms',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->string('platform_sign', 10)->nullable()->default(null)->comment('平台标识');
                $table->string('game_sign', 32)->nullable()->default(null)->comment('游戏标记');
                $table->tinyInteger('status')->nullable()->default(null)->comment('状态 1 启用 0 禁用');
                $table->integer('sort')->nullable()->default(null)->comment('排序');
                $table->tinyInteger('is_hot')->nullable()->default(null)->comment('是否热门 1 是 0 否');
                $table->tinyInteger('device')->default(0)->comment('设备  1.PC  2.H5 3.APP');
                $table->tinyInteger('is_maintain')->default(0)->comment('是否维护 0 否 1 是');
                $table->tinyInteger('is_recommend')->default(0)->comment('是否推荐 0 否 1 是');
                $table->string('icon', 128)->nullable()->default(null)->comment('图标');
                $table->nullableTimestamps();
                $table->index('platform_sign');
                $table->index('game_sign');
                $table->index('device');
                $table->index('is_hot');
            },
        );
        DB::statement("ALTER TABLE `game_platforms` comment '游戏与平台关联表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('game_platforms');
    }
}
