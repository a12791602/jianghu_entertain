<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateGameVendorReportDaysTable
 */
class CreateGameVendorReportDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'game_vendor_report_days',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->string('platform_sign', 10)->nullable()->default(null)->comment('所属平台标记');
                $table->string('game_vendor_sign', 32)->nullable()->default(null)->comment('游戏厂商标识');
                $table->string('game_vendor_name', 32)->nullable()->default(null)->comment('游戏厂商名称');
                $table->decimal('bet_money', 18, 4)->nullable()->default(null)->comment('下注金额');
                $table->decimal('effective_bet', 18, 4)->nullable()->default(null)->comment('有效下注金额');
                $table->decimal('win_money', 18, 4)->nullable()->default(0)->comment('中奖金额');
                $table->decimal('our_net_win', 18, 4)->nullable()->default(null)->comment('我们平台净赚金额');
                $table->decimal('commission', 18, 4)->nullable()->default(null)->comment('洗码');
                $table->date('day')->comment('日期');
                $table->nullableTimestamps();
            },
        );
        DB::statement("ALTER TABLE `game_vendor_report_days` comment '游戏厂商日报表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('game_vendor_report_days');
    }
}