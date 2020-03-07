<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateGamesTable
 */
class CreateFrontendUsersAuditsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'frontend_users_audits',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->string('mobile', 11)->nullable()->comment('会员账号');
                $table->string('guid', 16)->nullable()->comment('会员UID');
                $table->string('platform_sign', 10)->nullable()->comment('平台标识');
                $table->string('order_number', 64)->nullable()->comment('订单号');
                $table->string('type', 32)->nullable()->comment('金额类型');
                $table->decimal('amount', 18, 4)->nullable()->default(0)->comment('金额');
                $table->decimal('demand_bet', 18, 4)->nullable()->default(0)->comment('需求的打码量');
                $table->decimal('achieved_bet', 18, 4)->nullable()->default(0)->comment('完成的打码量');
                $table->tinyInteger('status')->nullable()->default(0)->comment('状态 0未完成 1已完成');
                $table->timestamp('achieved_time')->nullable()->default(null)->comment('完成的时间');
                $table->timestamps();
            },
        );
        DB::statement("ALTER TABLE `frontend_users_audits` comment '用户稽核表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('frontend_users_audits');
    }
}
