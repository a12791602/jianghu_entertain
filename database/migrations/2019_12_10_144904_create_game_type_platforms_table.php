<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateGameTypePlatformsTable
 */
class CreateGameTypePlatformsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'game_type_platforms',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->integer('platform_id')->nullable()->default(0)->comment('平台ID');
                $table->integer('type_id')->nullable()->default(0)->comment('分类ID')->unsigned();
                $table->string('device', 8)->nullable()->default(null)->comment('设备  1.PC  2.H5 3.APP');
                $table->integer('status')->nullable()->default(0)->comment('状态 0 禁用 1 启用');
                $table->nullableTimestamps();

                $table->foreign('type_id', 'fk_game_type_platforms_1')
                    ->references('id')->on('games_types')->onDelete('cascade')->onUpdate('cascade');
            },
        );
        DB::statement("ALTER TABLE `game_type_platforms` comment '代理平台和游戏类型的关联表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('game_type_platforms');
    }
}
