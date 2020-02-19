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
                $table->string('platform_sign', 10)->nullable()->default(null)->comment('平台标识');
                $table->string('name', 45)->nullable()->default(null)->comment('名称');
                $table->decimal('experience_min', 18, 4)->nullable()->default(null)->comment('级别最小经验值');
                $table->decimal('experience_max', 18, 4)->nullable()->default(null)->comment('级别最大经验值');
                $table->decimal('grade_gift', 18, 4)->nullable()->default(null)->comment('晋级礼金');
                $table->decimal('week_gift', 18, 4)->nullable()->default(null)->comment('周礼金');
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
