<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateBackendSystemMenusTable
 */
class CreateBackendSystemMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'backend_system_menus',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->string('label', 20)->nullable()->default(null)->comment('名称');
                $table->string('en_name', 50)->nullable()->default(null)->comment('英文名');
                $table->string('route', 50)->nullable()->default(null)->comment('路由');
                $table->integer('pid')->nullable()->default('0')->comment('菜单的父级别');
                $table->string('icon', 50)->nullable()->default(null)->comment('图标');
                $table->tinyInteger('display')->nullable()->default('1')->comment('是否显示 0否 1是');
                $table->integer('level')->nullable()->default('1')->comment('等级');
                $table->integer('sort')->nullable()->default(null)->comment('排序');
                $table->tinyInteger('type')->default('1')->comment('1 代表菜单要在左侧显示 2 代表按钮  3 代表普通链接');
                $table->nullableTimestamps();
            },
        );
        DB::statement("ALTER TABLE `backend_system_menus` comment '后台菜单'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('backend_system_menus');
    }
}
