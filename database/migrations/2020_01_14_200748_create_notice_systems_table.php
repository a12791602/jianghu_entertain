<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateNoticeSystemsTable
 */
class CreateNoticeSystemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'notice_systems',
            static function (Blueprint $table): void {
                $table->bigIncrements('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->integer('platform_id')->default(0)->comment('平台id');
                $table->string('title', 64)->default(' ')->comment('公告标题');
                $table->integer('h5_pic_id')->nullable()->comment('h5系统公告图片id');
                $table->integer('app_pic_id')->nullable()->comment('app系统公告图片id');
                $table->integer('pc_pic_id')->nullable()->comment('pc系统公告图片id');
                $table->json('device')->comment('所拥有的设备');
                $table->timestamp('start_time')->useCurrent()->comment('开始时间');
                $table->timestamp('end_time')->useCurrent()->comment('结束时间');
                $table->integer('author_id')->default(0)->comment('创建人id');
                $table->integer('last_editor_id')->default(0)->comment('最后编辑人id');
                $table->tinyInteger('status')->default(0)->comment('状态 0 禁用 1 启用');
                $table->timestamps();
                $table->index('title');
            },
        );
        DB::statement("ALTER TABLE `notice_systems` comment '系统公告表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('notice_systems');
    }
}
