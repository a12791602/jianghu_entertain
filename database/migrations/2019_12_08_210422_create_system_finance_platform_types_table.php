<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateSystemFinancePlatformTypesTable
 */
class CreateSystemFinancePlatformTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'system_finance_platform_types',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->string('platform_sign', 10)->nullable()->default(null)->comment('平台标识');
                $table->integer('type_id')->nullable()->default(null)->comment('所属类型id');
                $table->tinyInteger('is_hot')->nullable()->default(null)->comment('是否热门 1 是 0 否');
                $table->integer('sort')->nullable()->default(null)->comment('排序');
                $table->tinyInteger('is_discount')->nullable()->default(null)->comment('是否折扣');
                $table->tinyInteger('is_recommend')->nullable()->default(null)->comment('是否推荐');
                $table->nullableTimestamps();
            },
        );
        DB::statement("ALTER TABLE `system_finance_platform_types` comment '平台与金流类型关联表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('system_finance_platform_types');
    }
}
