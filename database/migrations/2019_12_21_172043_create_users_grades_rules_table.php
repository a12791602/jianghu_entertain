<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateUsersGradesRulesTable
 */
class CreateUsersGradesRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'users_grades_rules',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->string('platform_sign', 20)->nullable()->default(null)->comment('平台标识');
                $table->decimal('recharge', 18, 4)->nullable()->default(null)->comment('充值');
                $table->decimal('bet', 18, 4)->nullable()->default(null)->comment('打码量');
                $table->tinyInteger('type')->nullable()->default(null)->comment('1.充值  2.打码  3.充值或打码任一满足  4.充值和打码同时满足');
                $table->timestamps();
            },
        );
        DB::statement("ALTER TABLE `users_grades_rules` comment '用户等级规则'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('users_grades_rules');
    }
}
