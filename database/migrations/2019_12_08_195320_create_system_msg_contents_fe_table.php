<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateSystemMsgContentsFeTable
 */
class CreateSystemMsgContentsFeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'system_msg_contents_fe',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->integer('operate_admin_id')->nullable()->default(null)->comment('发送信息的管理员id');
                $table->string('operate_admin_name', 32)->nullable()->default(null)->comment('发送信息的管理员名称');
                $table->tinyInteger('type')->nullable()->default(null)->comment('1公告 2站内信');
                $table->string('title', 45)->nullable()->default(null)->comment('标题');
                $table->text('content')->nullable()->default(null)->comment('内容');
                $table->integer('sort')->nullable()->default(null)->comment('排序');
                $table->timestamp('start_time')->nullable()->default(null)->comment('开始时间');
                $table->timestamp('end_time')->nullable()->default(null)->comment('结束时间');
                $table->text('pic_path')->nullable()->default(null)->comment('图片路径');
                $table->text('describe')->nullable()->default(null)->comment('描述');
                $table->tinyInteger('status')->comment('1显示 0关闭');
                $table->unsignedTinyInteger('top')->nullable()->default('0')->comment('1置顶 0取消置顶');
                $table->nullableTimestamps();
            },
        );
        DB::statement("ALTER TABLE `system_msg_contents_fe` comment '前台消息'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('system_msg_contents_fe');
    }
}
