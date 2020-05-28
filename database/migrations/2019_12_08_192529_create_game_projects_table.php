<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateGameProjectsTable
 */
class CreateGameProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'game_projects',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->string('serial_number', 32)->nullable()->default(null)->comment('注单号 14-32');
                $table->string('their_serial_number', 32)->nullable()->default(null)->comment('三方单号 20-32');
                $table->string('their_notifyId', 50)->nullable()->default(null)->comment('三方通知单号 39-50');
                $table->integer('their_info_type')->nullable()->comment('三方信息类型说明');
                $table->integer('user_id')->comment('用户id');
                $table->string('guid', 16)->nullable()->default(null)->comment('客户游戏唯一标识id');
                $table->string('username', 64)->nullable()->default(null)->comment('用户名');
                $table->integer('top_id')->comment('最上级id');
                $table->integer('parent_id')->comment('上级id');
                $table->tinyInteger('is_tester')->default(0)->comment('是否测试用户 0否 1是');
                $table->string('platform_sign', 10)->nullable()->default(null)->comment('所属平台标记');
                $table->string('vip_level_id', 25)->nullable()->default(null)->comment('用户vip等级id');
                $table->integer('game_type')->nullable()->default(null)->comment('所属游戏类型 game_type_platforms表id');
                $table->integer('game_subtype')->nullable()->default(null)->comment('所属游戏子类型 game_sub_types表id');
                $table->string('game_sign', 32)->nullable()->default(null)->comment('所属游戏标记');
                $table->string('game_vendor_sign', 32)->nullable()->default(null)->comment('所属游戏厂商');
                $table->char('ip', 15)->nullable()->default(null)->comment('ip');
                $table->string('proxy_ip', 200)->nullable()->default(null)->comment('代理ip');
                $table->decimal('bet_money', 18, 4)->nullable()->default(null)->comment('下注金额');
                $table->decimal('odds', 18, 4)->nullable()->default(null)->comment('赔率');
                $table->decimal('win_money', 18, 4)->nullable()->default(0)->comment('输赢金额');
                $table->decimal('our_win_money', 18, 4)->nullable()->default(null)->comment('我们平台输赢金额');
                $table->decimal('our_net_win', 18, 4)->nullable()->default(null)->comment('我们平台净赚金额');
                $table->timestamp('delivery_time')->nullable()->default(null)->comment('派彩时间');
                $table->string('order_no', 128)->nullable()->default(null)->comment('系统订单号');
                $table->string('game_no', 128)->nullable()->default(null)->comment('游戏局号');
                $table->integer('grade_id')->nullable()->default(null)->comment('当前等级');
                $table->integer('commission_status')->nullable()->default(0)->comment('洗码统计状态 0未统计 1已统计');
                $table->tinyInteger('is_counted_report')->default(0)->comment('是否已计入报表  0否 1是');
                $table->tinyInteger('status')->default(0)->comment('0已投注 1已撤销 2未中奖 3已中奖 4已派奖');
                $table->timestamp('their_create_time')->nullable()->default(null)->comment('三方投注时间');
                $table->timestamp('thier_updated_time')->nullable()->default(null)->comment('三方最后更新时间');
                $table->tinyInteger('pull_thier_status')->default(0)->comment('第三方的拉取状态：0未拉取  1已拉取');
                $table->timestamp('pull_thier_time')->nullable()->default(null)->comment('第三方的拉取时间');
                $table->nullableTimestamps();
            },
        );
        DB::statement("ALTER TABLE `game_projects` comment '游戏记录表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('game_projects');
    }
}
