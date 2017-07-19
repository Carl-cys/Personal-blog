<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMogoPersonalInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('personal_info', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name','50')->default('')->comment('公告');
            $table->string('profile')->default('')->comment('简介');
            $table->string('address')->default('')->comment('地址');
            $table->string('img')->default('')->comment('图片');
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
        Schema::drop('personal_info');
    }
}
