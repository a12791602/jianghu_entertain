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
                $table->integer('platform_id')
                    ->unsigned()
                    ->nullable()
                    ->index('fk_system_platforms_has_games_system_platforms_idx_idx')
                    ->comment('平台id');
                $table->integer('game_id')
                    ->unsigned()
                    ->nullable()
                    ->index('fk_system_platforms_has_games_games_idx_idx')
                    ->unique()
                    ->comment('游戏id');
                $table->tinyInteger('status')->nullable()->comment('状态 1 启用 0 禁用');
                $table->integer('sort')->nullable()->comment('排序');
                $table->tinyInteger('hot_new')->nullable()->index()->comment('0 正常, 1 热门游戏, 2 新游戏');
                $table->tinyInteger('device')->default(0)->index()->comment('设备  1.PC  2.H5 3.APP');
                $table->tinyInteger('is_recommend')->default(0)->comment('是否推荐 0 否 1 是');
                $table->string('icon', 128)->nullable()->comment('图标');
                $table->timestamps();
                $table->foreign('game_id', 'fk_system_platforms_has_games_games_idx')
                    ->references('id')
                    ->on('games')
                    ->onUpdate('NO ACTION')
                    ->onDelete('NO ACTION');
                $table->foreign('platform_id', 'fk_system_platforms_has_games_system_platforms_idx')
                    ->references('id')
                    ->on('system_platforms')
                    ->onUpdate('NO ACTION')
                    ->onDelete('NO ACTION');
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
        Schema::table(
            'game_platforms',
            static function (Blueprint $table): void {
                $table->dropForeign('fk_system_platforms_has_games_games_idx');
                $table->dropForeign('fk_system_platforms_has_games_system_platforms_idx');
            },
        );
    }
}
