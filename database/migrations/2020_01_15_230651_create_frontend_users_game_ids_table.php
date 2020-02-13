<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateFrontendUsersGameIdsTable
 */
class CreateFrontendUsersGameIdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'frontend_users_game_ids',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->unsignedInteger('user_id');
            },
        );
        DB::statement("ALTER TABLE `frontend_users_game_ids` comment '客户游戏唯一标识id'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('frontend_users_game_ids');
    }
}
