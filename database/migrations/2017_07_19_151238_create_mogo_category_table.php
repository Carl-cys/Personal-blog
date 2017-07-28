    <?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMogoCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('category', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cate_name','50')->unique()->comment('分类名');
            $table->integer('parent_id')->unique()->comment('分类id');
            $table->string('path','50')->default('')->comment('路径');
            $table->string('cate_desc')->default('')->comment('描述');
            $table->string('seo_desc')->default('')->comment('seo用的描述');
            $table->string('seo_name')->default('')->comment('seo用的名字');
            $table->string('seo_title','50')->default('')->comment('seo用的标题');
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
        Schema::drop('category');
    }
}
