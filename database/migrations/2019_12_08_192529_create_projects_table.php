<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'projects',
            static function (Blueprint $table) {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->string('station_order_no', 128)->nullable()->default(null)->comment('注单号');
                $table->integer('user_id')->comment('用户id');
                $table->string('username', 64)->nullable()->default(null)->comment('用户名');
                $table->integer('top_id')->comment('最上级id');
                $table->integer('parent_id')->comment('上级id');
                $table->tinyInteger('is_tester')->default('0')->comment('是否测试用户 0否 1是');
                $table->string('platform_sign', 32)->nullable()->default(null)->comment('所属平台标记');
                $table->string('vip_level_id', 25)->nullable()->default(null)->comment('用户vip等级id');
                $table->string('game_sign', 32)->nullable()->default(null)->comment('所属游戏标记');
                $table->string('game_vendor_sign', 32)->nullable()->default(null)->comment('所属游戏厂商');
                $table->char('ip', 15)->nullable()->default(null)->comment('ip');
                $table->string('proxy_ip', 200)->nullable()->default(null)->comment('代理ip');
                $table->decimal('bet_money', 18, 4)->nullable()->default(null)->comment('下注金额');
                $table->decimal('odds', 18, 4)->nullable()->default(null)->comment('赔率');
                $table->decimal('win_money', 18, 4)->nullable()->default(null)->comment('输赢金额');
                $table->timestamp('delivery_time')->nullable()->default(null)->comment('派彩时间');
                $table->string('order_no', 128)->nullable()->default(null)->comment('系统订单号');
                $table->string('game_no', 128)->nullable()->default(null)->comment('游戏局号');
                $table->integer('grade_id')->nullable()->default(null)->comment('当前等级');
                $table->decimal('commission', 18, 4)->nullable()->default(null)->comment('洗码');
                $table->tinyInteger('status')->default('0')->comment('0已投注 1已撤销 2未中奖 3已中奖 4已派奖');
                $table->nullableTimestamps();
            },
        );
        \Illuminate\Support\Facades\DB::statement("ALTER TABLE `projects` comment '游戏记录表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
