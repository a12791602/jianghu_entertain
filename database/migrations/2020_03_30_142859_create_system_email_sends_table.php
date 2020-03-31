<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class CreateSystemEmailSendsTable
 */
class CreateSystemEmailSendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'system_email_sends',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->integer('email_id')->default(0);
                $table->integer('sender_id')->default(0);
                $table->timestamps();
            },
        );
        DB::statement("ALTER TABLE `system_email_sends` comment '商户发件箱'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('system_email_sends');
    }
}
