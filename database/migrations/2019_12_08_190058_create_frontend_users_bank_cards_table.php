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
                $table->integer('uid')->comment('用户UID');
                $table->string('mobile', 11)->comment('用户手机号码');
                $table->integer('bank_id')->comment('银行ID');
                $table->string('owner_name', 128)->nullable()->default(null)->comment('持卡人姓名');
                $table->string('card_number', 64)->nullable()->default(null)->comment('银行卡号');
                $table->integer('province_id')->comment('省份');
                $table->integer('city_id')->comment('市');
                $table->string('branch', 64)->nullable()->default(null)->comment('支行');
                $table->tinyInteger('status')->default('0')->comment('状态 0不可以 1可用');
                $table->tinyInteger('type')->nullable()->default(null)->comment('0 储蓄卡 1 信用卡');
                $table->timestamp('created_at')->nullable();
                $table->timestamp('updated_at')->nullable();
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
