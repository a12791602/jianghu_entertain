<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateSystemFePageBannersTable
 */
class CreateSystemFePageBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'system_fe_page_banners',
            static function (Blueprint $table) {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->string('title', 45)->nullable()->default(null)->comment('标题');
                $table->text('content')->nullable()->default(null)->comment('内容');
                $table->string('pic_path', 128)->nullable()->default(null)->comment('图片');
                $table->string('thumbnail_path', 128)->nullable()->default(null)->comment('缩略图');
                $table->tinyInteger('type')->nullable()->default(null)->comment('1内部 2活动');
                $table->string('redirect_url', 128)->nullable()->default(null)->comment('跳转地址');
                $table->integer('activity_id')->nullable()->default(null)->comment('活动id （frontend_activity_contents表id）');
                $table->tinyInteger('status')->nullable()->default(null)->comment('状态 0关闭 1开启');
                $table->timestamp('start_time')->nullable()->default(null)->comment('开始时间');
                $table->timestamp('end_time')->nullable()->default(null)->comment('结束时间');
                $table->unsignedInteger('sort')->nullable()->default(null)->comment('排序');
                $table->tinyInteger('flag')->comment('banner 属于哪端,1:网页端banner ,2:手机端banner');
                $table->nullableTimestamps();
            },
        );
        \Illuminate\Support\Facades\DB::statement("ALTER TABLE `system_fe_page_banners` comment '前端轮播图'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('system_fe_page_banners');
    }
}
