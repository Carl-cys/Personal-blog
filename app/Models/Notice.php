<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    protected $tablle = 'notices';
    /**
     *  公告
     */
    public static function notice()
    {
        $notice = Notice::take(4)->get();
        return $notice;
    }
}
