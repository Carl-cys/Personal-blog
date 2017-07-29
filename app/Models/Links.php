<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Links extends Model
{
   protected $table = 'links';

   /**
    * 友情链接
    * @return mixed
    */
   public static function links()
   {
      $links = Links::select(['name','order','link'])
          ->orderBy('order', 'desc')
          ->get();
      return $links;
   }
}
