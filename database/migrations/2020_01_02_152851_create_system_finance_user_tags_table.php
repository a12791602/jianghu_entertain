<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateSystemFinanceUserTagsTable
 */
class CreateSystemFinanceUserTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'system_finance_user_tags',
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->integer('platform_id')->default(0)->comment('平台id');
                $table->tinyInteger('is_online')->default(0)->comment('是否是线上支付');
                $table->integer('online_finance_id')->default(0)->comment('线上金流id');
                $table->integer('offline_finance_id')->default(0)->comment('线下金流id');
                $table->string('tag_id')->nullable()->default(null)->comment('会员标签id');
                $table->timestamps();
            },
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('system_finance_user_tags');
    }
}
