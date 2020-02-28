<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateFrontendUserLevelBenefitsTable
 */
class CreateFrontendUserLevelBenefitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'frontend_user_level_benefits',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->integer('user_id')->comment('用户ID');
                $table->tinyInteger('level')->comment('vip等级');
                $table->tinyInteger('weekly_gift')->default(0)->comment('周礼金状态');
                $table->tinyInteger('promotion_gift')->default(0)->comment('晋级礼金状态');
                $table->tinyInteger('red_packet')->default(0)->comment('红包加倍');
                $table->tinyInteger('sign_in')->default(0)->comment('签到加倍');
                $table->timestamps();
            },
        );
        DB::statement("ALTER TABLE `frontend_user_level_benefits` comment '会员专属权益'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('frontend_user_level_benefits');
    }
}
