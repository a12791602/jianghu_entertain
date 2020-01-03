<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateSystemCostomerServicesTable
 */
class CreateSystemCostomerServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'system_costomer_services',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->string('platform_sign', 10)->nullable()->default(null)->comment('平台标识');
                $table->string('name', 12)->nullable()->default(null)->comment('名称');
                $table->string('link', 255)->nullable()->default(null)->comment('链接');
                $table->string('number', 16)->nullable()->default(null)->comment('号码');
                $table->string('content', 64)->nullable()->default(null)->comment('内容');
                $table->tinyInteger('type')->nullable()->default(null)->comment('1.qq微信    2.在线');
                $table->tinyInteger('version')->nullable()->default(null)->comment('1.qq   2.微信  3.专业版  4.企业版');
                $table->timestamps();
            },
        );
        DB::statement("ALTER TABLE `system_costomer_services` comment '用户等级规则'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('system_costomer_services');
    }
}
