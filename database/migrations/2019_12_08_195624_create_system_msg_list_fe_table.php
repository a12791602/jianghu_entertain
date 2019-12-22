<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateSystemMsgListFeTable
 */
class CreateSystemMsgListFeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'system_msg_list_fe',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->integer('receive_user_id')->comment('接收的用户id');
                $table->integer('notices_content_id')->nullable()->default(null)->comment('消息内容表id');
                $table->tinyInteger('status')->comment('0未读  1已读');
                $table->nullableTimestamps();
            },
        );
        DB::statement("ALTER TABLE `system_msg_list_fe` comment '站内信'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('system_msg_list_fe');
    }
}
