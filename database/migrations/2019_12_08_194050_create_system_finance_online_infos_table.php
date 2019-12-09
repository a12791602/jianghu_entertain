<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSystemFinanceOnlineInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_finance_online_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->collation = 'utf8mb4_0900_ai_ci';
            $table->string('frontend_name', 64)->nullable()->default(null)->comment('前台名称');
            $table->string('frontend_remark')->nullable()->default(null)->comment('前台备注');
            $table->string('backend_name', 64)->nullable()->default(null)->comment('后台名称');
            $table->string('backend_remark')->nullable()->default(null)->comment('后台备注');
            $table->string('platform_sign', 32)->nullable()->default(null)->comment('平台标识');
            $table->integer('channel_id')->nullable()->default(null)->comment('所属通道id');
            $table->decimal('min', 20, 2)->nullable()->default(null)->comment('最小充值金额');
            $table->decimal('max', 20, 2)->nullable()->default(null)->comment('最大充值金额');
            $table->string('handle_fee', 10)->nullable()->default(null);
            $table->string('rebate_fee', 10)->nullable()->default(null)->comment('返点');
            $table->string('request_url')->nullable()->default(null)->comment('请求地址');
            $table->string('back_url')->nullable()->default(null)->comment('返回地址');
            $table->string('merchant_code')->nullable()->default(null)->comment('商户号');
            $table->text('merchant_secret')->nullable()->default(null)->comment('商户密钥');
            $table->text('public_key')->nullable()->default(null)->comment('第三方公钥');
            $table->text('private_key')->nullable()->default(null)->comment('第三方私钥');
            $table->string('app_ip')->nullable()->default(null)->comment('终端号');
            $table->string('vendor_url')->nullable()->default(null)->comment('第三方域名');
            $table->string('level_ids')->nullable()->default(null)->comment('可见的用户层级');
            $table->tinyInteger('status')->nullable()->default(null)->comment('状态 1 启用 0 禁用');
            $table->integer('sort')->nullable()->default(null)->comment('排序');
            $table->tinyInteger('auto_audit')->nullable()->default(null)->comment('是否自动审核 1 是 0 否');
            $table->nullableTimestamps();
        });
        \Illuminate\Support\Facades\DB::statement("ALTER TABLE `system_finance_online_infos` comment '线上金流详情表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('system_finance_online_infos');
    }
}
