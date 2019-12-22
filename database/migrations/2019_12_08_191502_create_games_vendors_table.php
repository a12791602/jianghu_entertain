<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateGamesVendorsTable
 */
class CreateGamesVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'games_vendors',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->string('name', 64)->nullable()->default(null)->comment('厂商名称');
                $table->string('sign', 64)->nullable()->default(null)->comment('厂商标识');
                $table->string('whitelist_ips')->nullable()->default(null)->comment('白名单');
                $table->integer('sort')->nullable()->default(null)->comment('排序');
                $table->tinyInteger('status')->comment('状态 0 禁用 1 启用');
                $table->integer('author_id')->default('0')->comment('添加人id');
                $table->integer('last_editor_id')->default('0')->comment('最后编辑人id');
                $table->nullableTimestamps();
            },
        );
        DB::statement("ALTER TABLE `games_vendors` comment '游戏厂商表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('games_vendors');
    }
}
