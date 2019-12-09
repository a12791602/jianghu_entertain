<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSystemFinanceOfflineInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_finance_offline_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->collation = 'utf8mb4_0900_ai_ci';
            $table->integer('type_id')->nullable()->default(null)->comment('所属类型id');
            $table->string('name', 64)->nullable()->default(null)->comment('名称');
            $table->string('remark')->nullable()->default(null)->comment('备注');
            $table->string('qrcode')->nullable()->default(null)->comment('二维码');
            $table->string('account', 64)->nullable()->default(null)->comment('账户');
            $table->string('username', 64)->nullable()->default(null)->comment('账户名');
            $table->decimal('min', 18, 4)->nullable()->default(null)->comment('最小充值金额');
            $table->decimal('max', 18, 4)->nullable()->default(null)->comment('最大充值金额');
            $table->integer('sort')->nullable()->default(null)->comment('排序');
            $table->tinyInteger('status')->nullable()->default(null)->comment('状态 1 启用 0 禁用');
            $table->tinyInteger('pay_type')->nullable()->default(null)->comment('支付类型 1 转账 2 发红包 3 转银行卡');
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
        Schema::dropIfExists('system_finance_offline_infos');
    }
}
