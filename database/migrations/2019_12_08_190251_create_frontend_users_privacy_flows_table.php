<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateFrontendUsersPrivacyFlowsTable
 */
class CreateFrontendUsersPrivacyFlowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'frontend_users_privacy_flows',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->integer('admin_id')->nullable()->default(null)->comment('管理员id （backend_admin_users表id）');
                $table->string('admin_name', 64)->nullable()->default(null)->comment('管理员名称');
                $table->integer('user_id')->nullable()->default(null)->comment('用户id （frontend_users表id）');
                $table->string('username', 64)->nullable()->default(null)->comment('用户名');
                $table->text('comment')->nullable()->default(null)->comment('内容');
                $table->nullableTimestamps();
            },
        );
        DB::statement("ALTER TABLE `frontend_users_privacy_flows` comment '用户权限变动记录'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('frontend_users_privacy_flows');
    }
}
