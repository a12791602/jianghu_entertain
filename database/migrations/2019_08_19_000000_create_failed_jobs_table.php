<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateFailedJobsTable
 */
class CreateFailedJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'failed_jobs',
            static function (Blueprint $table): void {
                $table->bigIncrements('id');

                $table->text('connection')->nullable();
                $table->text('queue')->nullable();
                $table->longText('payload')->nullable();
                $table->longText('exception')->nullable();
                $table->timestamp('failed_at')->useCurrent();
            },
        );
        DB::statement("ALTER TABLE `failed_jobs` comment '失败的任务表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('failed_jobs');
    }
}
