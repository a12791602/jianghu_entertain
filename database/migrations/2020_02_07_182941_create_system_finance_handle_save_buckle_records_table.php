<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateSystemFinanceHandleSaveBuckleRecordsTable
 */
class CreateSystemFinanceHandleSaveBuckleRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'system_finance_handle_save_buckle_records',
            static function (Blueprint $table): void {
                $table->bigIncrements('id');
                $table->string('platform_sign', 32)->nullable()->default(null)->comment('平台标识');
                $table->string('order_no', 128)->nullable()->default(null)->comment('订单号');
                $table->integer('user_id')->default(0)->comment('用户ID');
                $table->tinyInteger('type')->default(0)->comment('资金类型');
                $table->integer('admin_id')->default(0)->comment('操作人ID');
                $table->decimal('money', 18, 4)->nullable()->default(null)->comment('金额');
                $table->decimal('balance', 18, 4)->nullable()->default(null)->comment('余额');
                $table->string('remark', 256)->nullable()->default(null)->comment('备注');
                $table->tinyInteger('direction')->default(0)->comment('方向 1 入款 0 出款');
                $table->timestamps();
            },
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('system_finance_handle_save_buckle_records');
    }
}
