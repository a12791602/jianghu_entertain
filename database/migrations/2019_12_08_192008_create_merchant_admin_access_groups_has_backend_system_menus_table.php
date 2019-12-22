<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateMerchantAdminAccessGroupsHasBackendSystemMenusTable
 */
class CreateMerchantAdminAccessGroupsHasBackendSystemMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'merchant_admin_access_groups_has_backend_system_menus',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->integer('group_id')->nullable()->default(null)->comment('管理组ID')->unsigned();
                $table->integer('menu_id')->nullable()->default(null)->comment('菜单ID');
                $table->index('group_id', 'fk_merchant_admin_access_groups_has_backend_system_menus_1_idx');
                $table->nullableTimestamps();
                $table->foreign('group_id', 'fk_merchant_admin_access_groups_has_backend_system_menus_1')
                    ->references('id')->on('merchant_admin_access_groups')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            },
        );
        DB::statement("ALTER TABLE `merchant_admin_access_groups_has_backend_system_menus` comment '代理后台管理员组和菜单的关联表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('merchant_admin_access_groups_has_backend_system_menus');
    }
}
