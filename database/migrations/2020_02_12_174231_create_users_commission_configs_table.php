<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateUsersCommissionConfigsTable
 */
class CreateUsersCommissionConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'users_commission_configs',
            static function (Blueprint $table): void {
                $table->bigIncrements('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->string('platform_sign', 10)->nullable()->default(null)->comment('平台标识');
                $table->string('game_type_sign', 64)->default(0)->comment('游戏类型标识');
                $table->string('game_vendor_sign', 64)->default(0)->comment('游戏厂商标识');
                $table->decimal('bet', 18, 4)->nullable()->default(null)->comment('打码量');
                $table->index('platform_sign');
                $table->index('game_type_sign');
                $table->index('game_vendor_sign');
                $table->timestamps();
            },
        );
        DB::statement("ALTER TABLE `users_commission_configs` comment '洗码返利规则'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('users_commission_configs');
    }
}
