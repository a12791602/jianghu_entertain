<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateBackendAdminAuditFlowListsTable
 */
class CreateBackendAdminAuditFlowListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'backend_admin_audit_flow_lists',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->integer('admin_id')->nullable()->default(null)->comment('提交审核的管理员id');
                $table->integer('auditor_id')->nullable()->default(null)->comment('审核的管理员id ');
                $table->text('apply_note')->nullable()->default(null)->comment('备注');
                $table->text('auditor_note')->nullable()->default(null)->comment('审核时返回的备注');
                $table->string('admin_name', 64)->nullable()->default(null)->comment('管理员名称');
                $table->string('auditor_name', 64)->nullable()->default(null)->comment('审核人');
                $table->string('username', 64)->nullable()->default(null)->comment('用户名');
                $table->timestamp('created_at')->nullable()->default(null)->comment('applied_at');
                $table->timestamp('updated_at')->nullable()->default(null)->comment('audited_at');
            },
        );
        DB::statement("ALTER TABLE `backend_admin_audit_flow_lists` comment '审核流程表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('backend_admin_audit_flow_lists');
    }
}
