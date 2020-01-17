<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateFrontendUsersSpecificInfosTable
 */
class CreateFrontendUsersSpecificInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'frontend_users_specific_infos',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->string('nickname', 16)->nullable()->default(null)->comment('昵称');
                $table->string('avatar', 128)->nullable()->default(null)->comment('头像路径');
                $table->string('email', 32)->nullable()->default(null)->comment('邮箱');
                $table->string('zip_code', 6)->nullable()->default(null)->comment('邮编');
                $table->string('address', 128)->nullable()->default(null)->comment('地址');
                $table->tinyInteger('register_type')->default('0')->comment('注册类型：0.普通注册1.人工开户注册2.链接开户注册3.扫码开户注册');
                $table->integer('total_members')->nullable()->default('0')->comment('用户发展客户总数');
                $table->integer('user_id')->default('0')->comment('用户id');
                $table->string('domain')->nullable()->default(null)->comment('所属域名');
                $table->nullableTimestamps();
            },
        );
        DB::statement("ALTER TABLE `frontend_users_specific_infos` comment '用户信息拓展表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('frontend_users_specific_infos');
    }
}
