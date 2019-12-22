<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateUsersSalaryReportsTable
 */
class CreateUsersSalaryReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'users_salary_reports',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->string('plaform_sign')->nullable()->default(null)->comment('平台标识');
                $table->integer('top_id')->comment('最上级id');
                $table->integer('parent_id')->comment('上级id');
                $table->integer('user_id')->comment('用户id');
                $table->string('parent_username', 32)->nullable()->default(null)->comment('上级用户名');
                $table->string('username', 32)->nullable()->default(null)->comment('用户名');
                $table->unsignedInteger('amount')->default('0')->comment('日工资');
                $table->unsignedInteger('real_amount')->default('0')->comment('实际发放的日工资');
                $table->unsignedInteger('bets')->default('0')->comment('下注总额');
                $table->unsignedInteger('lose')->default('0')->comment('输赢');
                $table->integer('day')->comment('日期');
                $table->decimal('ratio', 5, 1)->default('0.0')->comment('比例');
                $table->tinyInteger('status')->default('0')->comment('状态 0未发放 1已发放');
                $table->integer('add_time')->default('0')->comment('统计时间');
                $table->integer('send_time')->default('0')->comment('发放时间');
                $table->integer('resend_time')->default('0')->comment('重新发放时间');
                $table->nullableTimestamps();
            },
        );
        DB::statement("ALTER TABLE `users_salary_reports` comment '用户日工资记录'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('users_salary_reports');
    }
}
