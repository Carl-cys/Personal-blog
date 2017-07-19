<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMogoUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nickname','50')->unique()->comment('管理员名称');
            $table->string('email')->comment('用户邮箱');
            $table->string('password')->comment('密码');
            $table->rememberToken();
            $table->string('pic')->comment('头像');
            $table->integer('status')->default(0)->comment('状态');
            $table->string('last_login_ip', '50')->nullable()->comment('登录ip');
            $table->dateTime('last_login_time')->nullable()->comment('登录时间');
            $table->integer('login_num')->default(0)->comment('登录次数');
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
        Schema::drop('users');
    }
}
