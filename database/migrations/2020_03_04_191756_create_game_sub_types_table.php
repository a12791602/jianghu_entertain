<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateGameSubTypesTable
 */
class CreateGameSubTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'game_sub_types',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->integer('parent_id')->nullable()->comment('父节点ID');
                $table->string('name', 64)->nullable()->default(null)->index()->comment('游戏名称');
                $table->string('sign', 64)->nullable()->default(null)->index()->comment('游戏标识');
                $table->tinyInteger('status')->index()->comment('状态 0 禁用 1 启用');
                $table->integer('author_id')->default(0)->comment('添加人id');
                $table->integer('last_editor_id')->default(0)->comment('最后编辑人id');
                $table->integer('sort')->index()->comment('排序');
                $table->nullableTimestamps();
            },
        );
        DB::statement("ALTER TABLE `game_sub_types` comment '游戏种类子分类表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('game_sub_types');
    }
}
