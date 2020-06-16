<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateReportDayUserGameVendorsTable
 */
class CreateReportDayUserGameVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'report_day_user_game_vendors',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->string('platform_sign', 10)->comment('所属平台标记');
                $table->integer('user_id')->comment('用户ID');
                $table->string('game_vendor_sign', 32)->comment('游戏厂商标识');
                $table->string('game_vendor_name', 32)->comment('游戏厂商名称');
                $table->decimal('bet_money', 18, 4)->nullable()->default(0)->comment('下注金额');
                $table->decimal('win_money', 18, 4)->nullable()->default(0)->comment('中奖金额');
                $table->decimal('effective_bet', 18, 4)->nullable()->default(0)->comment('有效下注金额');
                $table->decimal('rebate', 18, 4)->nullable()->default(0)->comment('洗码金额');
                $table->decimal('percent', 18, 4)->nullable()->default(0)->comment('洗码比例（百分比）');
                $table->date('day')->comment('日期');
                $table->nullableTimestamps();
            },
        );
        DB::statement("ALTER TABLE `report_day_user_game_vendors` comment '用户游戏厂商日报表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('report_day_user_game_vendors');
    }
}
