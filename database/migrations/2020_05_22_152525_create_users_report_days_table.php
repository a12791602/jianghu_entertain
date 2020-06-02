<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateUsersReportDaysTable
 */
class CreateUsersReportDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'users_report_days',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->string('platform_sign', 10)->nullable()->default(null)->comment('所属平台标记');
                $table->string('mobile', 11)->nullable()->default(null)->comment('用户账号（手机号码）');
                $table->string('guid', 16)->nullable()->default(null)->comment('用户游戏唯一标识id');
                $table->decimal('recharge_sum', 18, 4)->nullable()->default(0)->comment('入款金额');
                $table->integer('recharge_num')->default(0)->comment('入款次数');
                $table->decimal('withdraw_sum', 18, 4)->nullable()->default(0)->comment('出款金额');
                $table->integer('withdraw_num')->default(0)->comment('出款次数');
                $table->decimal('bet_sum', 18, 4)->nullable()->default(0)->comment('投注金额');
                $table->integer('bet_num')->default(0)->comment('投注次数');
                $table->decimal('reduced_sum', 18, 4)->nullable()->default(0)->comment('优惠金额');
                $table->decimal('effective_bet_sum', 18, 4)->nullable()->default(0)->comment('有效投注金额');
                $table->decimal('commission', 18, 4)->nullable()->default(0)->comment('佣金');
                $table->decimal('rebate', 18, 4)->nullable()->default(0)->comment('洗码返利');
                $table->decimal('activity_sum', 18, 4)->nullable()->default(0)->comment('活动金额');
                $table->decimal('game_win_sum', 18, 4)->nullable()->default(0)->comment('游戏中奖金额');
                $table->date('day')->comment('日期');
                $table->nullableTimestamps();
            },
        );
        DB::statement("ALTER TABLE `users_report_days` comment '用户个人日报表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('users_report_days');
    }
}
