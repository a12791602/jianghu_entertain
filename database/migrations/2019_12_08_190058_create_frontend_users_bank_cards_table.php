<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateFrontendUsersBankCardsTable
 */
class CreateFrontendUsersBankCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'frontend_users_bank_cards',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->string('platform_sign', 10)->nullable()->default(null)->comment('平台标识');
                $table->integer('user_id')->comment('用户id');
                $table->integer('bank_id')->default(0)->comment('银行ID, 0默认支付宝');
                $table->string('owner_name', 128)->nullable()->default(null)->comment('持卡人姓名');
                $table->string('card_number', 64)->nullable()->default(null)->comment('银行卡号');
                $table->string('branch', 64)->nullable()->default(null)->comment('支行');
                $table->string('code', 32)->nullable()->default(null)->comment('银行编码');
                $table->tinyInteger('status')->default('0')->comment('状态 0不可以 1可用');
                $table->tinyInteger('type')->nullable()->default(null)->comment('1 储蓄卡 2 支付宝');
                $table->timestamp('created_at')->nullable();
                $table->timestamp('updated_at')->nullable();
                
                $table->index('platform_sign');
                $table->index('user_id');
                $table->index('bank_id');
                $table->index('owner_name');
                $table->index('card_number');
                $table->index('code');
                $table->index('status');
                $table->index('type');
            },
        );
        DB::statement("ALTER TABLE `frontend_users_bank_cards` comment '用户银行卡'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('frontend_users_bank_cards');
    }
}
