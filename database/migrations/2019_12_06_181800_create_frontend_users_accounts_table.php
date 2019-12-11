<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateFrontendUsersAccountsTable
 */
class CreateFrontendUsersAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'frontend_users_accounts',
            static function (Blueprint $table) {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->integer('user_id')->comment('用户id （frontend_users表id）');
                $table->decimal('balance', 18, 4)->default('0.0000')->comment('资金')->unsigned();
                $table->decimal('frozen', 18, 4)->default('0.0000')->comment('冻结资金')->unsigned();
                $table->integer('integral')->nullable()->default(null)->comment('积分');
                $table->tinyInteger('status')->default('0')->comment('状态 0关闭 1开启');
                $table->nullableTimestamps();
            },
        );
        \Illuminate\Support\Facades\DB::statement("ALTER TABLE `frontend_users_accounts` comment '用户资金'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('frontend_users_accounts');
    }
}
