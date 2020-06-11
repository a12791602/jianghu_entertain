<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateSystemFinanceChannelsTable
 */
class CreateSystemFinanceChannelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'system_finance_channels',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->integer('type_id')->nullable()->default(null)->comment('所属类型id');
                $table->integer('vendor_id')->nullable()->default(null)->comment('所属厂商id');
                $table->string('name', 64)->nullable()->default(null)->index()->comment('名称');
                $table->string('sign', 64)->nullable()->default(null)->index()->comment('标识');
                $table->tinyInteger('request_mode')->nullable()->default(null)->comment('请求方式 1 jump 0 json');
                $table->string('request_url')->nullable()->default(null)->comment('回调地址');
                $table->string('banks_code')->nullable()->default(null)->comment('银行编号');
                $table->tinyInteger('status')->default(0)->comment('状态 1 启用 0 禁用');
                $table->string('desc', 64)->nullable()->default(null)->comment('描述');
                $table->integer('author_id')->default(0)->comment('添加人id');
                $table->integer('last_editor_id')->default(0)->comment('最后编辑人id');
                $table->nullableTimestamps();
            },
        );
        DB::statement("ALTER TABLE `system_finance_channels` comment '金流渠道表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('system_finance_channels');
    }
}
