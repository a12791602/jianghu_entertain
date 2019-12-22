<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateMerchantSystemMenusHasSystemRoutesMerchantsTable
 */
class CreateMerchantSystemMenusHasSystemRoutesMerchantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'merchant_system_menus_has_system_routes_merchants',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->integer('menu_id')->nullable()->default(null);
                $table->integer('route_id')->nullable()->default(null);
                $table->nullableTimestamps();
            },
        );
        DB::statement("ALTER TABLE `merchant_system_menus_has_system_routes_merchants` comment '代理后台菜单和路由的关联表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('merchant_system_menus_has_system_routes_merchants');
    }
}
