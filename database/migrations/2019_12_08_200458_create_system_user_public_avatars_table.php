<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateSystemUserPublicAvatarsTable
 */
class CreateSystemUserPublicAvatarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'system_user_public_avatars',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->string('pic_path', 128)->nullable()->default(null)->comment('图片');
                $table->nullableTimestamps();
            },
        );
        DB::statement("ALTER TABLE `system_user_public_avatars` comment '用户公共头像'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('system_user_public_avatars');
    }
}
