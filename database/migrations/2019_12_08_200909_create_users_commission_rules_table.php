<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateUsersCommissionRulesTable
 */
class CreateUsersCommissionRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'users_commission_rules',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->string('platform_sign', 10)->nullable()->default(null)->comment('平台标识');
                $table->decimal('bet_min', 18, 4)->nullable()->default(null)->comment('打码量范围下限');
                $table->decimal('bet_max', 18, 4)->nullable()->default(null)->comment('打码量范围上限');
                $table->string('rule_details')->nullable()->default(null)->comment('规则');
                $table->string('game_type_sign', 64)->nullable()->default(null)->comment('游戏类型标识');
                $table->string('game_vendor_sign', 64)->nullable()->default(null)->comment('游戏厂商标识');
                $table->nullableTimestamps();
            },
        );
        DB::statement("ALTER TABLE `users_commission_rules` comment '佣金返点规则'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('users_commission_rules');
    }
}
