<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateFrontendUserInvitedRecordsTable
 */
class CreateFrontendUserInvitedRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'frontend_user_invited_records',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->integer('user_id')->comment('用户id （frontend_users表id）');
                $table->string('username', 64)->nullable()->default(null)->comment('用户名');
                $table->integer('invite_code')->default('0')->comment('邀请码');
                $table->char('ip', 15)->nullable()->default(null)->comment('IP地址');
                $table->nullableTimestamps();
            },
        );
        DB::statement("ALTER TABLE `frontend_user_invited_records` comment '用户邀请记录'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('frontend_user_invited_records');
    }
}
