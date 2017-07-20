<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMogoNavigationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('navigation', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title','50')->default('')->comment('标题');
            $table->string('url')->default('')->comment('网址');
            $table->string('motto')->default('')->comment('格言');
            $table->string('img')->default('')->comment('主图');
            $table->string('desc')->default('')->comment('描述');
            $table->integer('order')->default('50')->comment('排序');
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
        Schema::drop('navigation');
    }
}
