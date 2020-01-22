<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateSystemEmailOfHeadsTable
 */
class CreateSystemEmailOfHeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'system_email_of_heads',
            static function (Blueprint $table): void {
                $table->bigIncrements('id');
                $table->integer('email_id')->default('0')->comment('邮件id');
                $table->tinyInteger('is_read')->default('0')->comment('是否已读 0 未读 1 已读');
                $table->timestamps();
            },
        );
        DB::statement("ALTER TABLE `system_email_of_heads` comment '总后台收件箱'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('system_email_of_heads');
    }
}
