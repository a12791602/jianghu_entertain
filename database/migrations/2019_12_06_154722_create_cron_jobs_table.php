<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateCronJobsTable
 */
class CreateCronJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'cron_jobs',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->string('command', 32)->nullable()->default(null)->comment('任务名称');
                $table->json('param')->nullable()->default(null)->comment('传递的参数');
                $table->string('schedule', 32)->nullable()->default(null)->comment('执行时间cron表达式');
                $table->tinyInteger('status')->default(0)->comment('开启状态 0关闭 1开启');
                $table->string('remarks', 64)->nullable()->default(null)->comment('定时任务用意描述备注');
                $table->nullableTimestamps();
            },
        );
        DB::statement("ALTER TABLE `cron_jobs` comment '定时任务'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('cron_jobs');
    }
}
