<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
   protected $table = 'resource';

   /** 最近分享
    * @return mixed
    */
   public static function resource()
   {
      $resource = Resource::where('deleted_status', '=', 0)
          ->orderBy( 'created_at','desc' )
          ->select(['title','id','download_url','created_at'])
          ->take(4)->get();

      return $resource;
   }
}
