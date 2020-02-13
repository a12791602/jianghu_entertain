<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateUsersCommissionConfigDetailsTable
 */
class CreateUsersCommissionConfigDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'users_commission_config_details',
            static function (Blueprint $table): void {
                $table->bigIncrements('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->integer('config_id')->default(0)->comment('所属洗码配置ID');
                $table->integer('grade_id')->default(0)->comment('用户等级ID');
                $table->decimal('percent', 5, 2)->nullable()->default(null)->comment('洗码比例');
                $table->decimal('grade_exp_max', 18, 4)->nullable()->default(null)->comment('该等级最大经验值');
                $table->timestamps();
            },
        );
        DB::statement("ALTER TABLE `users_commission_config_details` comment '佣金返点规则详情'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('users_commission_config_details');
    }
}
