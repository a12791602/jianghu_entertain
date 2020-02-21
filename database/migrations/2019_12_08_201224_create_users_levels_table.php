<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateUsersLevelsTable
 */
class CreateUsersLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'users_levels',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->string('platform_sign', 10)->nullable()->default(null)->comment('平台标识');
                $table->string('name', 64)->nullable()->default(null)->comment('名称');
                $table->string('allow_opts', 128)->nullable()->default(null)->comment('操作');
                $table->index('platform_sign');
                $table->nullableTimestamps();
            },
        );
        DB::statement("ALTER TABLE `users_levels` comment '用户层级'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('users_levels');
    }
}
