<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateUsersStationOrderTable
 */
class CreateUsersStationOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'users_station_order',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->string('platform_sign', 10)->nullable()->default(null)->comment('平台标识');
                $table->integer('user_id')->nullable()->default(null)->comment('用户ID');
                $table->string('game_sign', 32)->nullable()->default(null)->comment('游戏标识');
                $table->string('game_vendor_sign', 32)->nullable()->default(null)->comment('游戏厂商标识');
                $table->decimal('bet_money', 18, 4)->nullable()->default(null)->comment('下注金额');
                $table->decimal('odds', 18, 4)->nullable()->default(null)->comment('赔率');
                $table->decimal('win_money', 18, 4)->nullable()->default(null)->comment('输赢金额');
                $table->timestamp('station_time')->nullable()->default(null)->comment('驻单时间');
                $table->timestamp('delivery_time')->nullable()->default(null)->comment('派彩时间');
                $table->string('station_order_no', 128)->nullable()->default(null)->comment('注单号');
                $table->string('order_no', 128)->nullable()->default(null)->comment('系统订单号');
                $table->string('game_no', 128)->nullable()->default(null)->comment('游戏局号');
                $table->integer('grade_id')->nullable()->default(null)->comment('当前等级');
                $table->decimal('commission', 18, 4)->nullable()->default(null)->comment('洗码');
                $table->nullableTimestamps();
            },
        );
        DB::statement("ALTER TABLE `users_station_order` comment '用户注单表'");
    }

    /**
     * Reverse the migrations.zhus
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('users_station_order');
    }
}
