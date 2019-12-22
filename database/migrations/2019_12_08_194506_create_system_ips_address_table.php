<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateSystemIpsAddressTable
 */
class CreateSystemIpsAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'system_ips_address',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->string('ip', 16)->nullable()->default(null)->comment('IP地址');
                $table->string('country', 64)->nullable()->default(null)->comment('国家');
                $table->string('region', 64)->nullable()->default(null)->comment('省份');
                $table->string('city', 64)->nullable()->default(null)->comment('城市');
                $table->string('county', 64)->nullable()->default(null)->comment('县');
                $table->nullableTimestamps();
            },
        );
        DB::statement("ALTER TABLE `system_ips_address` comment 'ip所属地区'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('system_ips_address');
    }
}
