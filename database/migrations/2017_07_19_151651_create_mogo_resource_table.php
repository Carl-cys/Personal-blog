<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMogoResourceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('resource', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name','50')->default('')->comment('公告');
            $table->string('abstract')->default('')->comment('摘要');
            $table->integer('is_display')->default(0)->comment('是否显示');
            $table->string('title','50')->default('')->comment('标题');
            $table->integer('cate_id')->default(0)->comment('分类id');
            $table->string('download_url')->default('')->comment('下载地址');
            $table->string('demo_address')->default('')->comment('演示地址');
            $table->string('author')->default('')->comment('作者');
            $table->string('img')->default('')->comment('图片');
            $table->integer('deleted_status')->default(0)->comment('删除状态');
            $table->softDeletes();
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
        Schema::drop('resource');
    }
}
