<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class CreateSystemPromotionPicsTable
 */
class CreateSystemPromotionPicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'system_promotion_pics',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->string('pic', 128)->default('')->comment('图片');
                $table->integer('platform_id')->default(0)->comment('平台id');
                $table->integer('author_id')->default(0)->comment('创建人id');
                $table->integer('last_editor_id')->default(0)->comment('最后编辑人id');
                $table->tinyInteger('status')->default(0)->comment('状态 0 禁用 1 启用');
                $table->tinyInteger('device')->default(1)->comment('所属设备 1 pc 2 h5 3 app');
                $table->timestamps();
            },
        );
        DB::statement("ALTER TABLE `system_promotion_pics` comment '推广图片配置'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('system_promotion_pics');
    }
}
