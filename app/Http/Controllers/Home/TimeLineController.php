<?php

namespace App\Http\Controllers\Home;

use App\Models\TimeLine;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TimeLineController extends Controller
{
    /**
     * 获取时光轴
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function timeline()
    {
        $timeline = TimeLine::select(['id','title','content','created_at'])
            ->orderBy('created_at', 'desc')
            ->get();
        return view('home.timeline', compact('timeline'));
    }

}
