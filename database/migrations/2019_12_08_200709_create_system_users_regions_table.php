<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateSystemUsersRegionsTable
 */
class CreateSystemUsersRegionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'system_users_regions',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->string('region_id', 16)->nullable()->default(null)->comment('行政区域编码');
                $table->string('region_parent_id', 16)->nullable()->default(null)->comment('上级行政区域编码');
                $table->string('region_name', 64)->nullable()->default(null)->comment('名称');
                $table->tinyInteger('region_level')->nullable()->default(null)->comment('1.省 2.市(市辖区)3.县(区、市)4.镇(街道)');
                $table->nullableTimestamps();
            },
        );
        DB::statement("ALTER TABLE `system_users_regions` comment '行政区域'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('system_users_regions');
    }
}
