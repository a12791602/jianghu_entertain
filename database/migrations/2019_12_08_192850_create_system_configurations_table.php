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
                $table->integer('parent_id')->nullable()->default('0')->comment('父级id');
                $table->integer('pid')->comment('父类id, 顶级为0');
                $table->string('sign', 32)->nullable()->default(null)->comment('标识');
                $table->string('name', 32)->nullable()->default(null)->comment('名称');
                $table->string('description', 128)->nullable()->default(null)->comment('描述');
                $table->string('value', 128)->nullable()->default(null)->comment('配置的值');
                $table->integer('add_admin_id')->default('0')->comment('添加人, 系统添加为0');
                $table->integer('last_update_admin_id')->default('0')->comment('上次更改人id');
                $table->tinyInteger('status')->default('0')->comment('0 禁用 1 启用');
                $table->tinyInteger('display')->nullable()->default('1')->comment('是否显示 0不显示 1显示');
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
