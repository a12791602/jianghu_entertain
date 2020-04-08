<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class CreateGameTheirAccountTypesTable
 */
class CreateGameTheirAccountTypesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'game_their_account_types',
            static function (Blueprint $table): void {
                $table->integer('id', true);
                $table->integer('vendor_id')->comment('三方厂商id');
                $table->string('code', 45)->comment('编码 可能字符 可能是 数字');
                $table->tinyInteger('in_out')->default(1)->comment('出入类型 1玩家入款 (增加) 2 玩家扣款 (减少)');
                $table->string('description', 45)->comment('类型说明');
                $table->timestamps();
            },
        );
        DB::statement("ALTER TABLE `game_their_account_types` comment '游戏三方账号操作信息类说明'");
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::drop('game_their_account_types');
    }
}
