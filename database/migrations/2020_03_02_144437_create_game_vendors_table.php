<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateGameVendorsTable
 */
class CreateGameVendorsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'game_vendors',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->string('name', 64)->nullable()->comment('厂商名称')->index();
                $table->string('sign', 64)->nullable()->comment('厂商标识')->index();
                $table->integer('icon_id')->default(0)->comment('游戏图标');
                $table->integer('type_id')->comment('游戏类型id');
                $table->integer('sort')->default(0)->comment('排序');
                $table->tinyInteger('status')->default(1)->comment('状态 0 禁用 1 启用');
                $table->json('production')->nullable()->comment('正式站配置信息');
                $table->json('staging')->nullable()->comment('测试站配置信息');
                $table->integer('author_id')->default(0)->comment('添加人id');
                $table->integer('last_editor_id')->default(0)->comment('最后编辑人id');
                $table->boolean('needCreateAcc')->nullable()->default(0)->comment('是否登录之前需要先创建账号 1 需要 0不需先要创建用户');
                $table->timestamps();
            },
        );
        DB::statement("ALTER TABLE `game_vendors` comment '游戏厂商表'");
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('game_vendors');
    }
}
