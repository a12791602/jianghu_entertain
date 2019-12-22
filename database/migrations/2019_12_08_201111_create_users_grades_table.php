<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateUsersGradesTable
 */
class CreateUsersGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'users_grades',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->string('platform_sign', 32)->nullable()->default(null)->comment('平台标识');
                $table->string('name', 45)->nullable()->default(null)->comment('名称');
                $table->decimal('limit_min', 18, 4)->nullable()->default(null)->comment('该级别打码量范围的最小值');
                $table->decimal('limit_max', 18, 4)->nullable()->default(null)->comment('该级别打码量范围的最大值');
                $table->decimal('recharge_total', 18, 4)->nullable()->default(null)->comment('充值总额');
                $table->decimal('grade_gift', 18, 4)->nullable()->default(null)->comment('晋级礼金');
                $table->decimal('week_gift', 18, 4)->nullable()->default(null)->comment('周礼金');
                $table->integer('checkin_multi')->nullable()->default(null)->comment('签到加倍的倍数');
                $table->integer('red_envelope_multi')->nullable()->default(null)->comment('红包加倍的倍数');
                $table->integer('grade')->nullable()->default(null)->comment('用户等级');
                $table->nullableTimestamps();
            },
        );
        DB::statement("ALTER TABLE `users_grades` comment '用户等级'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('users_grades');
    }
}
