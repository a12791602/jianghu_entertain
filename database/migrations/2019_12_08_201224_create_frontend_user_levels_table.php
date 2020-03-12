<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateFrontendUserLevelsTable
 */
class CreateFrontendUserLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'frontend_user_levels',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->string('platform_sign', 10)->nullable()->default(null)->comment('平台标识');
                $table->string('name', 45)->nullable()->default(null)->comment('名称');
                $table->tinyInteger('level')->nullable()->default(null)->comment('等级ID');
                $table->integer('experience_min')->nullable()->default(null)->comment('级别最小经验值');
                $table->integer('experience_max')->nullable()->default(null)->comment('级别最大经验值');
                $table->decimal('promotion_gift', 18, 4)->nullable()->default(null)->comment('晋级礼金');
                $table->decimal('weekly_gift', 18, 4)->nullable()->default(null)->comment('周礼金');
                $table->index('platform_sign');
                $table->nullableTimestamps();
            },
        );
        DB::statement("ALTER TABLE `frontend_user_levels` comment '用户等级'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('frontend_user_levels');
    }
}
