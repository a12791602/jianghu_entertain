<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateSystemConfigurationsTable
 */
class CreateSystemConfigurationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'system_configurations',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->string('platform_sign', 10)->nullable()->default(null)->comment('平台标识');
                $table->integer('pid')->nullable()->default(0)->comment('父类id, 顶级为0');
                $table->string('sign', 32)->nullable()->default(null)->comment('标识');
                $table->string('name', 32)->nullable()->default(null)->comment('名称');
                $table->string('value', 128)->nullable()->default(null)->comment('配置的值');
                $table->integer('last_update_admin_id')->nullable()->default(null)->comment('上次更改人id');
                $table->tinyInteger('status')->default(0)->comment('状态 0禁用 1启用');
                $table->tinyInteger('display')->default(0)->comment('是否显示 0否 1是');
                $table->string('editable_type', 16)->nullable()->default(null)->comment('编辑的类型1.输入框 2.开启状态 3.下拉框');
                $table->index('platform_sign');
                $table->index('pid');
                $table->index('sign');
                $table->index('status');
                $table->index('display');
                $table->nullableTimestamps();
            },
        );
        DB::statement("ALTER TABLE `system_configurations` comment '系统配置'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('system_configurations');
    }
}
