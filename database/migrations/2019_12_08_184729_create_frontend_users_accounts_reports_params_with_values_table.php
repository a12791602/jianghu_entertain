<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateFrontendUsersAccountsReportsParamsWithValuesTable
 */
class CreateFrontendUsersAccountsReportsParamsWithValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'frontend_users_accounts_reports_params_with_values',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->integer('parent_id')->nullable()->default(null)->comment('上级id');
                $table->decimal('amount', 18, 4)->default('0.0000')->comment('变动前的资金')->unsigned();
                $table->integer('user_id')->comment('用户id（frontend_users表id）');
                $table->integer('project_id')->default(0)->comment('注单id');
                $table->integer('from_id')->default(0)->comment('转帐用户id');
                $table->integer('from_admin_id')->default(0)->comment('转帐管理员id');
                $table->integer('to_id')->default(0)->comment('接收转帐的用户id');
                $table->timestamp('created_at')->useCurrent();
                $table->timestamp('updated_at')->nullable();
            },
        );
        DB::statement("ALTER TABLE `frontend_users_accounts_reports_params_with_values` comment '帐变类型需要的字段信息'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('frontend_users_accounts_reports_params_with_values');
    }
}
