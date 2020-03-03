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
                $table->string('name', 64)->nullable()->comment('厂商名称');
                $table->string('sign', 64)->nullable()->comment('厂商标识');
                $table->integer('type_id')->comment('游戏类型id');
                $table->string('whitelist_ips')->nullable()->comment('白名单');
                $table->integer('sort')->nullable()->comment('排序');
                $table->tinyInteger('status')->comment('状态 0 禁用 1 启用');
                $table->text('urls')->nullable()->comment('存放三方调用urls');
                $table->text('test_urls')->nullable()->comment('存放三方调用测试urls');
                $table->string('app_id', 128)->nullable()->comment('终端号');
                $table->string('merchant_id', 50)->nullable()->comment('商户号');
                $table->text('merchant_secret')->nullable()->comment('商户密钥');
                $table->text('public_key')->nullable()->comment('公钥');
                $table->text('private_key')->nullable()->comment('私钥');
                $table->string('des_key')->nullable()->comment('des 密钥');
                $table->string('md5_key')->nullable()->comment('md5 密钥');
                $table->integer('author_id')->default(0)->comment('添加人id');
                $table->integer('last_editor_id')->default(0)->comment('最后编辑人id');
                $table->timestamps();
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
