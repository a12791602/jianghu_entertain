<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateBackendAdminAuditPasswordsListsTable
 */
class CreateBackendAdminAuditPasswordsListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'backend_admin_audit_passwords_lists',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->unsignedInteger('type')->comment('审核类型 1=password, 2=资金密码');
                $table->unsignedInteger('user_id')->comment('被审核用户的id');
                $table->text('audit_data')->nullable()->default(null)->comment('审核的数据');
                $table->tinyInteger('status')->default(0)->comment('0:审核中, 1:审核通过, 2:审核拒绝');
                $table->integer('audit_flow_id')->nullable()->default(null)->comment('提交人 与审核人的记录流程');
                $table->nullableTimestamps();
            },
        );
        DB::statement("ALTER TABLE `backend_admin_audit_passwords_lists` comment '审核流水表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('backend_admin_audit_passwords_lists');
    }
}
