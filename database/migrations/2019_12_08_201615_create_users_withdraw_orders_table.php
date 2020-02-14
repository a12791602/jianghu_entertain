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
                $table->string('platform_sign', 32)->nullable()->default(null)->comment('平台标识');
                $table->string('order_no', 128)->nullable()->default(null)->comment('订单号');
                $table->string('mobile', 11)->nullable()->default(null)->comment('会员账号');
                $table->integer('user_id')->nullable()->default(null)->comment('用户ID');
                $table->integer('bank_id')->nullable()->default(null)->comment('用户银行卡ID');
                $table->decimal('amount', 18, 4)->nullable()->default(null)->comment('提现金额');
                $table->decimal('before_balance', 18, 4)->nullable()->default(null)->comment('提现前余额');
                $table->decimal('handing_fee', 18, 4)->nullable()->default(null)->comment('手续费');
                $table->decimal('audit_fee', 18, 4)->nullable()->default(null)->comment('稽核扣款');
                $table->decimal('amount_received', 18, 4)->nullable()->default(null)->comment('到账金额');
                $table->tinyInteger('order_status')->default(0)->comment('订单状态 1 已出款 0 未出款');
                $table->tinyInteger('status')->default(0)->comment('审核状态 1 已审核 0 未审核');
                $table->string('remark')->nullable()->default(null)->comment('备注');
                $table->integer('admin_id')->nullable()->default(null)->comment('操作人ID');
                $table->tinyInteger('is_lock')->default(0)->comment('是否锁定 1 是 0 否');
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
