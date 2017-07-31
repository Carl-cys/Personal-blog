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
       $figure =  Figure::figure();
       if( is_file( "./templates/static/resource/resource.html" ) ){
           //存在就读取静态文件
           return file_get_contents("./templates/static/resource/resource.html");

       } else {
           //不存在就保存为静态文件
          $resourcestatic =  view('home.resource',compact('resource', 'request', 'figure'))->__toString();

           file_put_contents("./templates/static/resource/resource.html" , $resourcestatic );

           return view('home.resource',compact('resource', 'request', 'figure'));
       }
   }
}
