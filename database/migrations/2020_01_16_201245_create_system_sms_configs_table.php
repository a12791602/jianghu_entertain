<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateSystemSmsConfigsTable
 */
class CreateSystemSmsConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'system_sms_configs',
            static function (Blueprint $table): void {
                $table->bigIncrements('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->string('name', 16)->nullable()->comment('名称');
                $table->string('sign', 10)->nullable()->comment('标识');
                $table->string('merchant_code', 64)->nullable()->comment('商户号');
                $table->text('merchant_secret')->nullable()->comment('商户密钥');
                $table->text('public_key')->nullable()->comment('商户公钥');
                $table->integer('sms_num')->nullable()->comment('短信数量');
                $table->string('authorization_code', 255)->nullable()->comment('授权码');
                $table->string('url', 255)->nullable()->comment('请求地址');
                $table->integer('author_id')->nullable()->comment('创建人ID');
                $table->integer('last_editor_id')->nullable()->comment('最后修改人ID');
                $table->tinyInteger('status')->default(0)->comment('状态  0.关闭 1.开启');
                $table->timestamps();
            },
        );
        DB::statement("ALTER TABLE `system_sms_configs` comment '短信配置'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('system_sms_configs');
    }
}
