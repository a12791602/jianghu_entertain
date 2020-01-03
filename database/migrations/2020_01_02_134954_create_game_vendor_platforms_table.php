<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateGameVendorPlatformsTable
 */
class CreateGameVendorPlatformsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'game_vendor_platforms',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->integer('platform_id')->default(0)->comment('平台id');
                $table->integer('vendor_id')->default(0)->comment('厂商id');
                $table->integer('sort')->default(0)->comment('排序');
                $table->tinyInteger('is_maintain')->default(0)->comment('是否维护 0 否 1 是');
                $table->tinyInteger('status')->default(0)->comment('状态 0 禁用 1 启用');
                $table->tinyInteger('device')->default(0)->comment('设备');
                $table->timestamps();
            },
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('game_vendor_platforms');
    }
}
