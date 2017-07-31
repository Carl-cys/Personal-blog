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
        $figure =  Figure::figure();
        if( is_file( "./templates/static/timeline/timeline.html" ) ){
            //存在就读取静态文件
            return file_get_contents("./templates/static/timeline/timeline.html");
        } else {
            //不存在就保存为静态文件
            $timelinestaic = view('home.timeline', compact('timeline','request','figure'))->__toString();

            file_put_contents("./templates/static/timeline/timeline.html" , $timelinestaic );

            return view('home.timeline', compact('timeline','request','figure'));
        }

    }

}
