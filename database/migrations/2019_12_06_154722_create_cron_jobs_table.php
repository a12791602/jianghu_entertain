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
                $table->string('command', 32)->nullable()->default(null);
                $table->string('param', 64)->nullable()->default(null);
                $table->string('schedule', 32)->nullable()->default(null);
                $table->tinyInteger('status')->nullable()->default(null)->comment('开启状态 0关闭 1开启');
                $table->string('remarks', 64)->nullable()->default(null);
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
