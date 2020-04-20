<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class CreateGameProjectsSpecificInfosTable
 */
class CreateGameProjectsSpecificInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'game_projects_specific_infos',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->integer('game_project_id')->comment('游戏记录表id');
                $table->string('anchor_name', 32)->nullable()->default(null)->comment('主播名称');
                $table->string('gift_name', 32)->nullable()->default(null)->comment('礼物名称');
                $table->integer('room_id')->comment('游戏房间 game_rooms表id');
                $table->timestamps();
            },
        );
        DB::statement("ALTER TABLE `game_projects_specific_infos` comment '游戏记录扩展表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('game_projects_specific_infos');
    }
}
