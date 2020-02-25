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
                $table->string('name', 64)->nullable()->default(null)->comment('厂商名称');
                $table->string('sign', 64)->nullable()->default(null)->comment('厂商标识');
                $table->string('whitelist_ips')->nullable()->default(null)->comment('白名单');
                $table->integer('sort')->nullable()->default(null)->comment('排序');
                $table->tinyInteger('status')->comment('状态 0 禁用 1 启用');
                $table->text('url')->nullable()->default(null)->comment('存放三方调用urls');
                $table->text('test_url')->nullable()->default(null)->comment('存放三方调用测试urls');
                $table->string('app_id', 128)->nullable()->default(null)->comment('终端号');
                $table->string('merchant_code')->nullable()->default(null)->comment('商户号');
                $table->text('merchant_secret')->nullable()->default(null)->comment('商户密钥');
                $table->text('public_key')->nullable()->default(null)->comment('公钥');
                $table->text('private_key')->nullable()->default(null)->comment('私钥');
                $table->integer('author_id')->default('0')->comment('添加人id');
                $table->integer('last_editor_id')->default('0')->comment('最后编辑人id');
                $table->nullableTimestamps();
                $table->index('name');
                $table->index('sign');
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
