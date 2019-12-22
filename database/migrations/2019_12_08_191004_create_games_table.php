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
                $table->integer('type_id')->nullable()->default(null)->comment('所属种类ID');
                $table->integer('vendor_id')->nullable()->default(null)->comment('所属厂商ID');
                $table->string('name', 64)->nullable()->default(null)->comment('游戏名称');
                $table->string('sign', 64)->nullable()->default(null)->comment('游戏标识');
                $table->tinyInteger('request_mode')->nullable()->default(null)->comment('请求方式');
                $table->string('conver_url')->nullable()->default(null)->comment('额度转换地址');
                $table->string('test_conver_url')->nullable()->default(null)->comment('额度转换测试地址');
                $table->string('check_balance_url')->nullable()->default(null)->comment('检查余额地址');
                $table->string('test_check_balance_url')->nullable()->default(null)->comment('测试检查余额地址');
                $table->string('check_order_url')->nullable()->default(null)->comment('检查订单地址');
                $table->string('test_check_order_url')->nullable()->default(null)->comment('检查订单测试地址');
                $table->string('in_game_url')->nullable()->default(null)->comment('进入游戏地址');
                $table->string('test_in_game_url')->nullable()->default(null)->comment('测试进入游戏地址');
                $table->string('get_station_order_url')->nullable()->default(null)->comment('获取用户驻单地址');
                $table->string('test_get_station_order_url')->nullable()->default(null)->comment('获取用户驻单测试地址');
                $table->tinyInteger('is_test')->nullable()->default(null)->comment('是否在测试 1 测试中 0 正式');
                $table->tinyInteger('status')->nullable()->default(null)->comment('状态 1 启用 0 禁用');
                $table->string('app_id', 128)->nullable()->default(null)->comment('终端号');
                $table->string('authorization_code')->nullable()->default(null)->comment('授权码');
                $table->string('merchant_code')->nullable()->default(null)->comment('商户号');
                $table->text('merchant_secret')->nullable()->default(null)->comment('商户密钥');
                $table->text('public_key')->nullable()->default(null)->comment('公钥');
                $table->text('private_key')->nullable()->default(null)->comment('私钥');
                $table->integer('author_id')->default('0')->comment('添加人id');
                $table->integer('last_editor_id')->default('0')->comment('最后编辑人id');
                $table->nullableTimestamps();
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
