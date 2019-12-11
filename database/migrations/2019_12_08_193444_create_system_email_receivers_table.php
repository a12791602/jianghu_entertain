<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSystemEmailReceiversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'system_email_receivers',
            static function (Blueprint $table) {
                $table->increments('id');
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->integer('email_id')->default('0');
                $table->tinyInteger('receiver_type')->default('0')->comment('接收人类型 3会员 2 厅主 1总控');
                $table->integer('receiver_id')->default('0');
                $table->tinyInteger('is_read')->default('0')->comment('是否已读 0 未读 1 已读');
                $table->timestamp('created_at')->useCurrent();
                $table->timestamp('updated_at')->useCurrent();
            },
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('system_email_members');
    }
}
