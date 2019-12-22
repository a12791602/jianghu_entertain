<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateSystemPlatformBanksTable
 */
class CreateSystemPlatformBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'system_platform_banks',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->string('platform_sign', 32)->default(' ')->comment('运营商标记');
                $table->integer('bank_id')->default('0')->comment('银行id');
                $table->tinyInteger('status')->default('0')->comment('状态 0 禁用 1 启用');
                $table->timestamp('created_at')->useCurrent();
                $table->timestamp('updated_at')->useCurrent();
            },
        );
        DB::statement("ALTER TABLE `system_platform_banks` comment '银行与平台关联表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('system_platform_banks');
    }
}
