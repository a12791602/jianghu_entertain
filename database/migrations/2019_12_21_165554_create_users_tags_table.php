<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateUsersTagsTable
 */
class CreateUsersTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'users_tags',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->string('platform_sign', 10)->nullable()->default(null)->comment('平台标识');
                $table->string('title', 10)->nullable()->default(null)->comment('标签名称');
                $table->tinyInteger('no_withdraw')->nullable()->default(null)->comment('是否禁止提现  0否 1是');
                $table->tinyInteger('no_login')->nullable()->default(null)->comment('是否禁止登陆  0否 1是');
                $table->tinyInteger('no_play')->nullable()->default(null)->comment('是否禁止游戏  0否 1是');
                $table->tinyInteger('no_promote')->nullable()->default(null)->comment('是否禁止推广  0否 1是');
                $table->timestamps();
            },
        );
        DB::statement("ALTER TABLE `users_tags` comment '用户标签'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('users_tags');
    }
}
