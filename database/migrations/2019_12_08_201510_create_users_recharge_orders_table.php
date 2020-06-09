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
                $table->string('platform_sign', 10)->nullable()->default(null)->comment('平台标识');
                $table->string('platform_no', 128)->nullable()->default(null)->comment('第三方订单号');
                $table->string('platform_need_no', 128)->nullable()->default(null)->comment('第三方需要的订单号');
                $table->string('order_no', 128)->nullable()->default(null)->comment('订单号');
                $table->integer('user_id')->nullable()->default(null)->comment('用户ID');
                $table->integer('finance_type_id')->default(0)->comment('金流类型id');
                $table->integer('finance_channel_id')->nullable()->default(null)->comment('充值渠道ID');
                $table->decimal('money', 18, 4)->nullable()->default(null)->comment('订单金额');
                $table->decimal('real_money', 18, 4)->nullable()->default(null)->comment('真实付款金额');
                $table->decimal('discount_money', 18, 4)->nullable()->default(null)->comment('优惠金额');
                $table->decimal('handling_money', 18, 4)->nullable()->default(null)->comment('手续费');
                $table->decimal('arrive_money', 18, 4)->nullable()->default(null)->comment('到帐金额');
                $table->tinyInteger('status')->default(0)->comment('状态 0 审核中 1 审核通过');
                $table->integer('admin_id')->nullable()->default(null)->comment('操作人ID');
                $table->tinyInteger('is_online')->nullable()->default(null)->comment('是否是线上存款 1 是 0 否');
                $table->tinyInteger('recharge_status')->nullable()->default(0)->comment('支付状态 1 已支付 0 未支付');
                $table->string('remark')->nullable()->default(null)->comment('后台处理时的备注');
                $table->string('card_number', 64)->nullable()->default(null)->comment('用户线下入款时的卡号');
                $table->string('bank', 128)->nullable()->default(null)->comment('支行');
                $table->string('branch', 128)->nullable()->default(null)->comment('支行');
                $table->string('top_up_remark')->nullable()->default(null)->comment('用户充值时的备注');
                $table->string('client_ip', 30)->nullable()->default(null)->comment('下单ip');
                $table->string('snap_merchant_no', 128)->nullable()->default(null)->comment('商户编号快照');
                $table->string('snap_merchant_code')->nullable()->default(null)->comment('商户号快照');
                $table->string('snap_merchant', 64)->nullable()->default(null)->comment('商户快照');
                $table->string('snap_finance_type', 64)->nullable()->default(null)->comment('支付方式快照');
                $table->string('snap_user_grade', 64)->nullable()->default(null)->comment('会员等级快照');
                $table->string('snap_account', 128)->nullable()->default(null)->comment('收款账户快照');
                $table->string('snap_bank', 64)->nullable()->default(null)->comment('收款银行快照');
                $table->integer('snap_user_level')->default(0)->comment('用户vip等级快照');
                $table->nullableTimestamps();
                $table->index('platform_sign');
                $table->index('platform_no');
                $table->index('order_no');
                $table->index('snap_merchant_no');
                $table->index('snap_merchant_code');
                $table->index('snap_merchant');
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
