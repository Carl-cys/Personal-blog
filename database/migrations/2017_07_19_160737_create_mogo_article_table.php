<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMogoArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('article', function (Blueprint $table) {
            $table->increments('id');
            $table->string('abstract')->default('')->comment('文章摘要');
            $table->string('title','50')->default('')->comment('文章标题');
            $table->integer('cate_id')->default(0)->comment('分类id');
            $table->integer('clicks')->default(0)->comment('浏览数');
            $table->integer('read_top')->default(0)->comment('置顶');
            $table->integer('read_ecommend')->default(0)->comment('阅读推荐');
            $table->integer('deleted_status')->default(0)->comment('删除状态');
            $table->text('content')->comment('内容');
            $table->string('author')->default('')->comment('文章作者');
            $table->string('img')->default('')->comment('主图');
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
        Schema::drop('article');
    }
}
