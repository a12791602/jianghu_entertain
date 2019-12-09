<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSystemBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_banks', function (Blueprint $table) {
            $table->increments('id');
            $table->collation = 'utf8mb4_0900_ai_ci';
            $table->string('name', 32)->default(' ')->comment('银行名称');
            $table->string('code', 32)->default(' ')->comment('银行编码');
            $table->tinyInteger('status')->default('0')->comment('状态 0关闭 1开启');
            $table->integer('author_id')->default('0')->comment('创建人');
            $table->integer('last_editor_id')->default('0')->comment('最后修改人');
            $table->nullableTimestamps();
        });
        \Illuminate\Support\Facades\DB::statement("ALTER TABLE `system_banks` comment '出入款账户配置表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('system_banks');
    }
}
