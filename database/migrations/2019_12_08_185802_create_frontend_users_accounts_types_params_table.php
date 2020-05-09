<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateFrontendUsersAccountsTypesParamsTable
 */
class CreateFrontendUsersAccountsTypesParamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'frontend_users_accounts_types_params',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->string('label', 32)->nullable()->default(null)->comment('名称');
                $table->string('param', 32)->nullable()->default(null)->comment('参数');
                $table->string('rule', 128)->default(null)->comment('规则');
                $table->tinyInteger('is_search_ease')->default(0)->comment('0.放入params字段内部 1.放到表字段');
                $table->nullableTimestamps();
            },
        );
        DB::statement("ALTER TABLE `frontend_users_accounts_types_params` comment '帐变类型所需字段'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('frontend_users_accounts_types_params');
    }
}
