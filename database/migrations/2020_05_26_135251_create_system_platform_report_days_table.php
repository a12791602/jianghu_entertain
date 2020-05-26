<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateSystemPlatformReportDaysTable
 */
class CreateSystemPlatformReportDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'system_platform_report_days',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->string('platform_sign', 10)->comment('平台标记');
                $table->decimal('recharge_sum', 18, 4)->nullable()->default(0)->comment('入款金额');
                $table->decimal('withdraw_sum', 18, 4)->nullable()->default(0)->comment('出款金额');
                $table->decimal('reduced_sum', 18, 4)->nullable()->default(0)->comment('优惠金额');
                $table->decimal('activity_sum', 18, 4)->nullable()->default(0)->comment('活动金额');
                $table->date('day')->comment('日期');
                $table->nullableTimestamps();
            },
        );
        DB::statement("ALTER TABLE `system_platform_report_days` comment '平台日报表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('system_platform_report_days');
    }
}
