<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateGameVendorUrlFieldsTable
 */
class CreateGameVendorUrlFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'game_vendor_url_fields',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->string('url_name', 50)->comment('URL 名称');
                $table->string('url_comment')->comment('URL 注释');
                $table->nullableTimestamps();
            },
        );
        DB::statement("ALTER TABLE `game_vendor_url_fields` comment '游戏厂商需要的 URL 字段'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('game_vendor_url_fields');
    }
}
