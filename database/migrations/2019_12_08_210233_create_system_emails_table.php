<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateSystemEmailsTable
 */
class CreateSystemEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'system_emails',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->tinyInteger('is_timing')->default('0')->comment('是否是定时发送  0 不是 1 是');
                $table->tinyInteger('is_send')->default('0')->comment('是否发送 0 未发送 1 已发送');
                $table->string('title')->default(' ')->comment('邮件标题');
                $table->binary('content')->nullable()->default(null)->comment('邮件内容');
                $table->timestamp('send_time')->useCurrent()->comment('发送时间');
                $table->tinyInteger('type')->default('1')->comment('邮件类型 1 厅主到总控 2 厅主到会员 3 总控到厅主');
                $table->text('receiver_ids')->nullable()->comment('接收人id');
                $table->integer('sender_id')->default('0')->comment('发送人id');
                $table->text('receivers')->nullable()->comment('接收人');
                $table->string('platform_sign')->default(' ')->comment('平台标记');
                $table->timestamp('created_at')->useCurrent();
                $table->timestamp('updated_at')->useCurrent();
            },
        );
        DB::statement("ALTER TABLE `system_emails` comment '邮件信息表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('system_emails');
    }
}
