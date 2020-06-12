<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateReportDayPlatformGamesTable
 */
class CreateReportDayPlatformGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'report_day_platform_games',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->string('platform_sign', 10)->comment('所属平台标记');
                $table->string('game_sign', 32)->comment('所属游戏标记');
                $table->string('game_name', 32)->comment('所属游戏名称');
                $table->string('game_vendor_sign', 32)->comment('所属游戏厂商');
                $table->decimal('bet_money', 18, 4)->nullable()->default(0)->comment('下注金额');
                $table->decimal('effective_bet', 18, 4)->nullable()->default(0)->comment('有效下注金额');
                $table->decimal('win_money', 18, 4)->nullable()->default(0)->comment('中奖金额');
                $table->decimal('our_net_win', 18, 4)->nullable()->default(0)->comment('我们平台净赚金额');
                $table->decimal('commission', 18, 4)->nullable()->default(0)->comment('洗码');
                $table->date('day')->comment('日期');
                $table->nullableTimestamps();
            },
        );
        DB::statement("ALTER TABLE `report_day_platform_games` comment '代理平台游戏日报表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('report_day_platform_games');
    }
}
