<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateNoticeMarqueesTable
 */
class CreateNoticeMarqueesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'notice_marquees',
            static function (Blueprint $table): void {
                $table->bigIncrements('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->integer('platform_id')->default(0)->comment('平台id');
                $table->string('title', 16)->default(' ')->comment('公告标题');
                $table->text('content')->nullable()->default(null)->comment('公告内容');
                $table->string('device')->nullable()->default(null)->comment('设备');
                $table->tinyInteger('status')->default(0)->comment('状态 0 禁用 1 启用');
                $table->timestamp('start_time')->useCurrent()->comment('开始时间');
                $table->timestamp('end_time')->useCurrent()->comment('结束时间');
                $table->integer('author_id')->default(0)->comment('创建人id');
                $table->integer('last_editor_id')->default(0)->comment('最后编辑人id');
                $table->timestamps();
                $table->index('title');
            },
        );
        DB::statement("ALTER TABLE `notice_marquees` comment '跑马灯公告表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('notice_marquees');
    }
}
