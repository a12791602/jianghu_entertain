<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateGameRoomsTable
 */
class CreateGameRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'game_rooms',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->integer('game_series_id')->nullable()->comment('游戏ID');
                $table->integer('room_id')->nullable()->comment('房间ID');
                $table->string('room_name', 32)->nullable()->comment('房间名称');
                $table->nullableTimestamps();
            },
        );
        DB::statement("ALTER TABLE `game_rooms` comment '游戏房间表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('game_rooms');
    }
}
