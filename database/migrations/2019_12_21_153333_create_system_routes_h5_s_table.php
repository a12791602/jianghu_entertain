<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateSystemRoutesH5STable
 */
class CreateSystemRoutesH5STable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'system_routes_h5_s',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->string('route_name', 128)->nullable()->default(null)->comment('路由名称');
                $table->string('controller', 128)->nullable()->default(null)->comment('控制器');
                $table->string('method', 64)->nullable()->default(null)->comment('方法');
                $table->integer('frontend_model_id')->nullable()->default(null)->comment('模块id');
                $table->string('title', 45)->nullable()->default(null)->comment('标题');
                $table->text('description')->nullable()->default(null)->comment('描述');
                $table->tinyInteger('is_open')->nullable()->default('0')->comment('0封闭式 1开放式');
                $table->index('is_open');
                $table->nullableTimestamps();
            },
        );
        DB::statement("ALTER TABLE `system_routes_h5_s` comment 'H5路由'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('system_routes_h5_s');
    }
}
