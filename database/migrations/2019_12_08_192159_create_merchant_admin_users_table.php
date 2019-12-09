<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMerchantAdminUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant_admin_users', function (Blueprint $table) {
            $table->increments('id');
            $table->collation = 'utf8mb4_0900_ai_ci';
            $table->string('name', 64)->nullable()->default(null)->comment('名称');
            $table->string('email', 20)->nullable()->default(null);
            $table->string('password')->nullable()->default(null)->comment('密码');
            $table->text('remember_token')->nullable()->default(null)->comment('token');
            $table->tinyInteger('is_test')->nullable()->default('0')->comment('是否测试号   0不是 1是');
            $table->integer('group_id')->nullable()->default(null)->comment('管理员组id');
            $table->integer('status')->nullable()->default('1')->comment('状态 0关闭 1开启');
            $table->string('platform_sign', 10)->nullable()->default(null)->comment('平台id');
            $table->decimal('chargeable_fund', 10, 2)->nullable()->default(null)->comment('后台管理员手中拥有的 可以充值的余额');
            $table->nullableTimestamps();
        });
        \Illuminate\Support\Facades\DB::statement("ALTER TABLE `merchant_admin_users` comment '后台管理员'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('merchant_admin_users');
    }
}
