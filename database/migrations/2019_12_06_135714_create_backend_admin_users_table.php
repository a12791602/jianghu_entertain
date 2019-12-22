<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateBackendAdminUsersTable
 */
class CreateBackendAdminUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'backend_admin_users',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->string('name', 64)->nullable()->default(null)->comment('名称');
                $table->string('email')->nullable()->default(null)->comment('邮箱');
                $table->timestamp('email_verified_at')->nullable()->default(null)->comment('验证邮箱的时间');
                $table->string('password')->nullable()->default(null)->comment('密码');
                $table->text('remember_token')->nullable()->default(null)->comment('token');
                $table->tinyInteger('is_test')->nullable()->default('0')->comment('是否测试号   0不是 1是');
                $table->integer('group_id')->nullable()->default(null)->comment('管理员组id')->unsigned();
                $table->tinyInteger('status')->nullable()->default('1')->comment('状态 0关闭 1开启');
                $table->unsignedInteger('super_id')->nullable()->default(null)->comment('是否超管');
                $table->decimal('chargeable_fund', 10, 2)->nullable()->default(null)->comment('后台管理员手中拥有的 可以充值的余额');

                $table->index('group_id', 'fk_backend_admin_users_1_idx');
                $table->nullableTimestamps();


                $table->foreign('group_id', 'fk_backend_admin_users_1')
                    ->references('id')->on('backend_admin_access_groups')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            },
        );
        DB::statement("ALTER TABLE `backend_admin_users` comment '后台管理员'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('backend_admin_users');
    }
}
