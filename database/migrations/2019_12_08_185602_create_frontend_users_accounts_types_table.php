<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateFrontendUsersAccountsTypesTable
 */
class CreateFrontendUsersAccountsTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'frontend_users_accounts_types',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->string('name', 32)->nullable()->default(null)->comment('名称');
                $table->string('sign', 32)->nullable()->default(null)->comment('标识');
                $table->tinyInteger('in_out')->default('1')->comment('出入类型 1增加 2减少');
                $table->string('param', 45)->nullable()->default(null)->comment('参数');
                $table->tinyInteger('frozen_type')->default('1')->comment('冻结类型');
                $table->tinyInteger('activity_sign')->default('1')->comment('活动标识');
                $table->integer('admin_id')->default('0')->comment('管理员id');

                $table->index('sign');

                $table->nullableTimestamps();
            },
        );
        DB::statement("ALTER TABLE `frontend_users_accounts_types` comment '帐变类型'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('frontend_users_accounts_types');
    }
}
