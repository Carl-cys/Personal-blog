<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimeLine extends Model
{
    protected $table = 'timeline';

    /**
     * 一路走来
     * @return mixed
     */
    public static function timeLine()
    {
        $timeline = TimeLine::select(['title','content','id','created_at'])
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();
        return $timeline;
    }
}
