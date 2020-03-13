<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateSystemPlatformSkinTable
 */
class CreateSystemPlatformSkinTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'system_platform_skins',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->string('name', 32)->nullable()->comment('皮肤名称');
                $table->string('sign', 16)->nullable()->comment('皮肤标识');
                $table->tinyInteger('type')->nullable()->comment('类型： 1.PC 2.H5 3.APP');
                $table->timestamps();
            },
        );
        DB::statement("ALTER TABLE `system_platform_skins` comment '平台皮肤表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('system_platform_skins');
    }
}
