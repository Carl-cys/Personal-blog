<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Figure extends Model
{
    protected $table = 'figure';

    /**
     * 获取图片加格言
     * @return mixed
     */
    public static function figure()
    {
        return Figure::select([ 'url','motto', 'img', 'id' ])->get();
    }
}
