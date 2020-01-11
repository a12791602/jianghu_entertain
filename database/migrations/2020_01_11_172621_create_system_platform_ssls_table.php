<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateSystemPlatformSslsTable
 */
class CreateSystemPlatformSslsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'system_platform_ssls',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->string('platform_sign', 10)->nullable()->default(null)->comment('平台标识');
                $table->text('private_key')->nullable()->default(null)->comment('私钥');
                $table->text('public_key')->nullable()->default(null)->comment('公钥');
                $table->string('interval_str', 32)->nullable()->default(null)->comment('间隔字符串');
                $table->timestamps();
            },
        );
        DB::statement("ALTER TABLE `system_platform_ssls` comment '平台SSL证书'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('system_platform_ssls');
    }
}
