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
                $table->integer('user_id')->comment('用户id （frontend_users表id）');
                $table->string('username', 64)->nullable()->default(null)->comment('用户名');
                $table->string('bank_sign', 32)->nullable()->default(null)->comment('银行标识');
                $table->string('bank_name', 64)->nullable()->default(null)->comment('银行名称');
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
