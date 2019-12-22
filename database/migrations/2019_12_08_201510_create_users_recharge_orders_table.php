<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateUsersRechargeOrdersTable
 */
class CreateUsersRechargeOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'users_recharge_orders',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->string('platform_sign', 32)->nullable()->default(null)->comment('平台标识');
                $table->string('order_no', 128)->nullable()->default(null)->comment('订单号');
                $table->integer('user_id')->nullable()->default(null)->comment('用户ID');
                $table->string('finance_type_sign', 64)->nullable()->default(null)->comment('金流类型标识');
                $table->integer('finance_channel_id')->nullable()->default(null)->comment('充值渠道ID');
                $table->decimal('money', 18, 4)->nullable()->default(null)->comment('订单金额');
                $table->decimal('real_money', 18, 4)->nullable()->default(null)->comment('真实付款金额');
                $table->decimal('discount_money', 18, 4)->nullable()->default(null)->comment('优惠金额');
                $table->tinyInteger('status')->nullable()->default(null)->comment('状态 0 审核中 1 审核通过');
                $table->integer('admin_id')->nullable()->default(null)->comment('操作人ID');
                $table->tinyInteger('is_online')->nullable()->default(null)->comment('是否是线上存款 1 是 0 否');
                $table->tinyInteger('recharge_status')->nullable()->default(null)->comment('支付状态 1 已支付 0 未支付');
                $table->string('remark')->nullable()->default(null)->comment('备注');
                $table->nullableTimestamps();
            },
        );
        DB::statement("ALTER TABLE `users_recharge_orders` comment '用户入款订单表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('users_recharge_orders');
    }
}
