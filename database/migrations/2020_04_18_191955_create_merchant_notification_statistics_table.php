<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class CreateMerchantNotificationStatisticsTable
 */
class CreateMerchantNotificationStatisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'merchant_notification_statistics',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->integer('platform_id')->default(0)->comment('平台id');
                $table->string('message_type')->comment('消息类型');
                $table->integer('count')->default(0)->comment('通知计数');
                $table->timestamps();
            },
        );
        DB::statement("ALTER TABLE `merchant_notification_statistics` comment '商户通知表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('merchant_notification_statistics');
    }
}
