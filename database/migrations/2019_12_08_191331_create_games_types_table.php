<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateGamesTypesTable
 */
class CreateGamesTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'games_types',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->string('name', 64)->nullable()->default(null)->comment('游戏名称');
                $table->string('sign', 64)->nullable()->default(null)->comment('游戏标识');
                $table->tinyInteger('status')->comment('状态 0 禁用 1 启用');
                $table->integer('author_id')->default('0')->comment('添加人id');
                $table->integer('last_editor_id')->default('0')->comment('最后编辑人id');
                $table->nullableTimestamps();
            },
        );
        DB::statement("ALTER TABLE `games_types` comment '游戏种类表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('games_types');
    }
}
