<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateSystemConfigurationStandardsTable
 */
class CreateSystemConfigurationStandardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'system_configuration_standards',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->integer('pid')->nullable()->default(0)->comment('父类id, 顶级为0');
                $table->string('sign', 32)->nullable()->default(null)->comment('标识');
                $table->string('name', 32)->nullable()->default(null)->comment('名称');
                $table->string('value', 128)->nullable()->default(null)->comment('配置的值');
                $table->tinyInteger('status')->default(0)->comment('状态 0禁用 1启用');
                $table->tinyInteger('display')->default(0)->comment('是否显示 0否 1是');
                $table->string('editable_type', 16)->nullable()->default(null)->comment('编辑的类型1.输入框 2.开启状态 3.下拉框');
                $table->nullableTimestamps();
            },
        );
        DB::statement("ALTER TABLE `system_configuration_standards` comment '系统配置默认标准'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('system_configuration_standards');
    }
}
