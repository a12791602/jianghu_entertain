<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class CreateSystemIpWhiteListsTable
 */
class CreateSystemIpWhiteListsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'system_ip_white_lists',
            static function (Blueprint $table): void {
                $table->integer('id', true);
                $table->string('ips')->nullable()->comment('白名单集');
                $table->tinyInteger('type')->nullable()->default(0)->comment(
                    '白名单类型
1 支付
2 游戏',
                );
                $table->integer('finance_vendor_id')->unsigned()->nullable()->comment('支付厂商id');
                $table->integer('game_vendor_id')->unsigned()->nullable()->comment('游戏厂商id');
                $table->timestamps();
            },
        );
        DB::statement("ALTER TABLE `frontend_users_accounts_types_groups` comment 'ip 白名单表'");
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('system_ip_white_lists');
    }
}
