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
                $table->unsignedInteger('user_id');
            },
        );
        DB::statement("ALTER TABLE `frontend_users_game_ids` comment '前端用户唯一ID'");
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
