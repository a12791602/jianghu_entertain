<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class CreateStaticResourcesTable
 */
class CreateStaticResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'static_resources',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->string('path', 128)->default('')->comment('资源路径');
                $table->tinyInteger('type')->nullable(false)->comment('类型');
                $table->string('table_name', 64)->default(null)->comment('表名');
                $table->tinyInteger('static_type')->default(1)->comment('1.图片 2.json');
                $table->timestamps();
            },
        );
        DB::statement("ALTER TABLE `static_resources` comment '静态资源'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('static_resources');
    }
}
