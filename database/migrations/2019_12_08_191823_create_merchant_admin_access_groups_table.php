<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMerchantAdminAccessGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant_admin_access_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->collation = 'utf8mb4_0900_ai_ci';
            $table->string('group_name', 10)->nullable()->default(null)->comment('角色组名称');
            $table->tinyInteger('status')->nullable()->default('1')->comment('状态：0关闭 1开启');
            $table->string('platform_sign', 10)->nullable()->default(null)->comment('平台标识');
            $table->tinyInteger('is_super')->nullable()->default('0')->comment('是否超级管理组');
            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('merchant_admin_access_groups');
    }
}
