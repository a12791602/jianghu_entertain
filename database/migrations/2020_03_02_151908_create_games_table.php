<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateGamesTable
 */
class CreateGamesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'games',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->integer('type_id')->nullable()->comment('游戏分类ID');
                $table->integer('type_child_id')->nullable()->comment('游戏子分类ID');
                $table->integer('vendor_id')->nullable()->comment('所属厂商ID');
                $table->string('name', 64)->nullable()->comment('游戏名称');
                $table->string('sign', 64)->nullable()->comment('游戏标识');
                $table->tinyInteger('request_mode')->nullable()->comment('请求方式');
                $table->tinyInteger('status')->nullable()->comment('状态 1 启用 0 禁用');
                $table->integer('author_id')->default(0)->comment('添加人id');
                $table->integer('last_editor_id')->default(0)->comment('最后编辑人id');
                $table->timestamps();
            },
        );
        DB::statement("ALTER TABLE `games` comment '游戏表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
}
