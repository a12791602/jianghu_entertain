<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateFrontendUsersAccountsTypesGroupsTable
 */
class CreateFrontendUsersAccountsTypesGroupsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'frontend_users_accounts_types_groups',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->string('group_name', 16)->nullable()->comment('账变类型组名称');
                $table->timestamps();
            },
        );
        DB::statement("ALTER TABLE `frontend_users_accounts_types_groups` comment '账变类型组'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('frontend_users_accounts_types_groups');
    }
}
