<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateUsersWithdrawOrdersTable
 */
class CreateUsersWithdrawOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'users_withdraw_orders',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->string('platform_sign', 10)->nullable()->default(null)->comment('平台标识');
                $table->string('order_no', 128)->nullable()->default(null)->comment('订单号');
                $table->string('mobile', 11)->nullable()->default(null)->comment('会员账号');
                $table->integer('user_id')->nullable()->default(null)->comment('用户ID');
                $table->decimal('amount', 18, 4)->nullable()->default(null)->comment('提现金额');
                $table->decimal('before_balance', 18, 4)->nullable()->default(null)->comment('提现前余额');
                $table->decimal('handing_fee', 18, 4)->nullable()->default(null)->comment('手续费');
                $table->decimal('audit_fee', 18, 4)->nullable()->default(null)->comment('稽核扣款');
                $table->decimal('amount_received', 18, 4)->nullable()->default(null)->comment('到账金额');
                $table->tinyInteger('account_type')->default(1)->comment('收款账户类型 1 银行卡, 2 支付宝');
                $table->tinyInteger('is_audit')->default(0)->comment('是否稽核扣款 0否 1是');
                $table->tinyInteger('status')->default(0)->comment('审核状态 0 未审核 1 已通过 2 已拒绝');
                $table->decimal('month_total', 18, 4)->nullable()->default(null)->comment('当月存款总额');
                $table->tinyInteger('num_withdrawal')->default(0)->comment('今日出款次数');
                $table->tinyInteger('num_top_up')->default(0)->comment('今日存款次数');
                $table->text('account_snap')->nullable()->default(null)->comment('收款账户快照');
                $table->string('remark')->nullable()->default(null)->comment('备注');
                $table->tinyInteger('reviewer_id')->nullable()->default(null)->comment('审核人ID');
                $table->tinyInteger('admin_id')->nullable()->default(null)->comment('操作人ID');
                $table->timestamp('operation_at')->nullable()->default(null)->comment('操作时间');
                $table->timestamp('review_at')->nullable()->default(null)->comment('审核时间');
                $table->timestamps();
            },
        );
        DB::statement("ALTER TABLE `users_withdraw_orders` comment '用户出款订单表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('users_withdraw_orders');
    }
}
