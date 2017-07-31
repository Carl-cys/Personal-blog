<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
   protected $table = 'article';

   
   /**
    * 获取文章排序
    * @param $field
    * @param $order
    * @return mixed
    */
   public static function articleSorting( $field, $order )
   {
      $article = Article::where('deleted_status', '=', 0)
          ->orderBy($field, $order)
          ->select(['title','clicks','content','author','created_at','id','img','abstract','cate_id','deleted_status'])
          ->paginate(5);
      return $article;
   }
}
