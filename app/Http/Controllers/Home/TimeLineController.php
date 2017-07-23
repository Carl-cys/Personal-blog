<?php

namespace App\Http\Controllers\Home;

use App\Models\Figure;
use App\Models\TimeLine;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TimeLineController extends Controller
{
    /**
     * 获取时光轴
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function timeline( Request $request )
    {
        $timeline = TimeLine::select(['id','title','content','created_at'])
            ->orderBy('created_at', 'desc')
            ->get();
        //图片加格言
        $figure =  Figure::select([ 'url','motto', 'img', 'id' ])->get();
        return view('home.timeline', compact('timeline','request','figure'));
    }

}
