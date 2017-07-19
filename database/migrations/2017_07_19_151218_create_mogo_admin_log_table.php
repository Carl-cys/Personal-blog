<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMogoAdminLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_log', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nickname','50')->default('')->comment('名称');
            $table->integer('status')->default(0)->comment('状态');
            $table->text('content')->comment('内容');
            $table->string('login_ip', '50')->default('')->comment('登录ip');
            $table->dateTime('login_time')->comment('登录时间');
            $table->integer('user_id')->default(0)->comment('用户ip');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('admin_log');
    }
}
