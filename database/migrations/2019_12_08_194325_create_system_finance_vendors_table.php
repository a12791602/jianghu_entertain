<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateSystemFinanceVendorsTable
 */
class CreateSystemFinanceVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'system_finance_vendors',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->string('name', 64)->nullable()->default(null)->comment('厂商名称');
                $table->string('sign', 64)->nullable()->default(null)->comment('厂商标记');
                $table->string('whitelist_ips')->nullable()->default(null)->comment('ip白名单');
                $table->tinyInteger('status')->default('0')->comment('状态 0 禁用 1 启用');
                $table->integer('author_id')->default('0')->comment('添加人id');
                $table->integer('last_editor_id')->default('0')->comment('最后编辑人id');
                $table->nullableTimestamps();
            },
        );
        DB::statement("ALTER TABLE `system_finance_vendors` comment '金流厂商表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('system_finance_vendors');
    }
}
