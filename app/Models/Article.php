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
          ->select(['cate_id','id', 'abstract','title','created_at','deleted_status','author','img'])
          ->get();
      return $article;
   }
}
