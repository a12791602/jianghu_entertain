<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateSystemFinanceTypesTable
 */
class CreateSystemFinanceTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'system_finance_types',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->string('name', 64)->nullable()->default(null)->index()->comment('类型名');
                $table->string('sign', 64)->nullable()->default(null)->index()->comment('类型标记');
                $table->string('ico')->nullable()->default(null)->comment('类型图标');
                $table->tinyInteger('is_online')->nullable()->default(null)->comment('是否是在线支付 1 是 0 否');
                $table->tinyInteger('direction')->nullable()->default(null)->comment('金流方向 1 入款 0 出款');
                $table->tinyInteger('status')->default(0)->comment('状态 1 启用 0 禁用');
                $table->integer('author_id')->default(0)->comment('添加人id');
                $table->integer('last_editor_id')->default(0)->comment('最后编辑人id');
                $table->nullableTimestamps();
            },
        );
        DB::statement("ALTER TABLE `system_finance_types` comment '金流类型表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('system_finance_types');
    }
}
