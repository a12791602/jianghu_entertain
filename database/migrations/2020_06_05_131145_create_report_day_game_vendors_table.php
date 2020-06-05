<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateReportDayGameVendorsTable
 */
class CreateReportDayGameVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'report_day_game_vendors',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->string('game_vendor_sign', 32)->nullable()->default(null)->comment('游戏厂商标识');
                $table->decimal('bet', 18, 4)->nullable()->default(0)->comment('下注金额');
                $table->decimal('win_money', 18, 4)->nullable()->default(0)->comment('中奖金额');
                $table->decimal('tax', 18, 4)->nullable()->default(0)->comment('税收金额');
                $table->decimal('effective_bet', 18, 4)->nullable()->default(0)->comment('有效下注金额');
                $table->decimal('rebate', 18, 4)->nullable()->default(0)->comment('洗码返利');
                $table->decimal('commission', 18, 4)->nullable()->default(0)->comment('佣金');
                $table->date('day')->comment('日期');
                $table->nullableTimestamps();
            },
        );
        DB::statement("ALTER TABLE `report_day_game_vendors` comment '游戏厂商日总报表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('report_day_game_vendors');
    }
}
