<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateMerchantAdminUsersTable
 */
class CreateMerchantAdminUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'merchant_admin_users',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->integer('platform_id')->unsigned()->nullable()->index()->comment('平台id');
                $table->string('platform_sign', 10)->nullable()->default(null)->comment('平台标记');
                $table->string('name', 16)->nullable()->default(null)->comment('名称');
                $table->string('email', 64)->nullable()->default(null)->comment('邮箱');
                $table->string('password')->nullable()->default(null)->comment('密码');
                $table->text('remember_token')->nullable()->default(null)->comment('token');
                $table->integer('group_id')->nullable()->default(null)->comment('管理员组id');
                $table->tinyInteger('status')->default(1)->comment('状态 0关闭 1开启');
                $table->decimal('chargeable_fund', 10, 2)->nullable()->default(null)->comment('后台管理员手中拥有的 可以充值的余额');
                $table->index('platform_sign');
                $table->index('email');
                $table->index('group_id');
                $table->index('status');
                $table->nullableTimestamps();
            },
        );
        DB::statement("ALTER TABLE `merchant_admin_users` comment '后台管理员'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('merchant_admin_users');
    }
}
