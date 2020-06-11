<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateSystemFinanceOfflineInfosTable
 */
class CreateSystemFinanceOfflineInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'system_finance_offline_infos',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->integer('type_id')->nullable()->default(null)->comment('所属类型id');
                $table->integer('platform_id')->default(0)->comment('平台id');
                $table->integer('bank_id')->default(0)->comment('银行卡id');
                $table->string('name', 64)->nullable()->default(null)->index()->comment('名称');
                $table->string('remark')->nullable()->default(null)->comment('备注');
                $table->string('qrcode')->nullable()->default(null)->comment('二维码');
                $table->string('account', 64)->nullable()->default(null)->index()->comment('账户');
                $table->string('username', 64)->nullable()->default(null)->index()->comment('账户名');
                $table->decimal('min_amount', 18, 4)->nullable()->default(null)->comment('最小充值金额');
                $table->decimal('max_amount', 18, 4)->nullable()->default(null)->comment('最大充值金额');
                $table->integer('sort')->default(0)->comment('排序');
                $table->tinyInteger('status')->default(0)->comment('状态 1 启用 0 禁用');
                $table->tinyInteger('pay_type')->nullable()->default(null)->comment('支付类型 1 转账 2 发红包 3 转银行卡');
                $table->string('branch', 128)->comment('支行')->default(null);
                $table->integer('author_id')->default(0)->comment('添加人id');
                $table->integer('last_editor_id')->default(0)->comment('最后编辑人id');
                $table->decimal('service_fee', 20, 4)->default(0)->comment('手续费');
                $table->nullableTimestamps();
                $table->index('name');
                $table->index('account');
                $table->index('username');
            },
        );
        DB::statement("ALTER TABLE `system_finance_offline_infos` comment '线下金流详情表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('system_finance_offline_infos');
    }
}
