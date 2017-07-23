<?php

namespace App\Http\Controllers\Home;

use App\Models\Figure;
use App\Models\Resource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ResourceController extends Controller
{
    /**
     * 资源页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
   public function resource( Request $request)
   {
        $resource = Resource::where('is_display', '1')
            ->where('deleted_status', '0')
            ->select(['demo_address','id','abstract','is_display','author','title','img','created_at'])->paginate(10);
       //图片加格言
       $figure =  Figure::select([ 'url','motto', 'img', 'id' ])->get();
       return view('home.resource',compact('resource', 'request', 'figure'));
   }
}
