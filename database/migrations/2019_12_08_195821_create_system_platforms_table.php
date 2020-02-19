<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateSystemPlatformsTable
 */
class CreateSystemPlatformsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'system_platforms',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->string('cn_name', 64)->nullable()->default(null)->comment('中文名称');
                $table->string('en_name', 64)->nullable()->default(null)->comment('英文名称');
                $table->string('sign', 15)->nullable()->default(null)->comment('标识');
                $table->string('games_types')->nullable()->default(null)->comment('游戏类型设置');
                $table->string('finance_types')->nullable()->default(null)->comment('金流类型设置');
                $table->string('agency_method', 20)->nullable()->default(null)->comment('代理方式  1.PC  2.H5 3.APP');
                $table->integer('owner_id')->nullable()->default(null)->comment('所属人id');
                $table->timestamp('start_time')->nullable()->default(null)->comment('开始时间');
                $table->timestamp('end_time')->nullable()->default(null)->comment('结束时间');
                $table->integer('sms_num')->nullable()->default(null)->comment('短信条数');
                $table->timestamp('maintain_start')->nullable()->default(null)->comment('维护开始时间');
                $table->timestamp('maintain_end')->nullable()->default(null)->comment('维护结束时间');
                $table->tinyInteger('status')->nullable()->default('1')->comment('状态 0关闭 1开启');
                $table->integer('author_id')->nullable()->default(null)->comment('管理员id');
                $table->integer('last_editor_id')->nullable()->default(null)->comment('最后修改的管理员id');
                $table->nullableTimestamps();
            },
        );
        DB::statement("ALTER TABLE `system_platforms` comment '平台'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('system_platforms');
    }
}
