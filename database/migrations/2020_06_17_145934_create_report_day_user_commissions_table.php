<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateReportDayUserCommissionsTable
 */
class CreateReportDayUserCommissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'report_day_user_commissions',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->string('platform_sign', 10)->comment('平台标记');
                $table->integer('agent_id')->comment('代理用户ID');
                $table->string('mobile', 11)->comment('用户账号（手机号码）');
                $table->string('guid', 16)->comment('用户游戏唯一标识id');
                $table->decimal('win_lose', 18, 4)->nullable()->default(0)->comment('游戏输赢');
                $table->decimal('commission', 18, 4)->nullable()->default(0)->comment('佣金');
                $table->integer('level')->nullable()->default(1)->comment('代理层级');
                $table->date('day')->comment('日期');
                $table->nullableTimestamps();
            },
        );
        DB::statement("ALTER TABLE `report_day_user_commissions` comment '用户佣金报表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('report_day_user_commissions');
    }
}
