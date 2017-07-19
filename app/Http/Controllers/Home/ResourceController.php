<?php

namespace App\Http\Controllers\Home;

use App\Models\Resource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ResourceController extends Controller
{
    /**
     * 资源页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
   public function resource()
   {
//       id	int	10	0	0	-1	-1	0	0		0					-1	0
//cate_id	int	11	0	-1	0	0	0	0		0	分类id				0	0
//abstract	varchar	255	0	-1	0	0	0	0		0	文章摘要	utf8	utf8_general_ci		0	0
//is_display	int	11	0	0	0	-1	0	0	0	0	是否显示				0	0
//title	varchar	255	0	0	0	0	0	0		0	文章标题	utf8	utf8_unicode_ci		0	0
//download_url	varchar	255	0	-1	0	0	0	0		0	下载地址	utf8	utf8_unicode_ci		0	0
//demo_address	varchar	255	0	-1	0	0	0	0		0	演示地址	utf8	utf8_unicode_ci		0	0
//author	varchar	255	0	-1	0	0	0	0		0	文章作者	utf8	utf8_general_ci		0	0
//deleted_status	int	11	0	-1	0	-1	0	0	0	0	删除状态				0	0
//img	varchar	255	0	-1	0	0	0	0		0	主图	utf8	utf8_unicode_ci		0	0
//created_at	timestamp	0	0	-1	0	0	0	0		0					0	0
//updated_at	timestamp	0	0	-1	0	0	0	0		0					0	0
//deleted_at	timestamp	0	0	-1	0	0	0	0		0					0	0

        $resource = Resource::where('is_display', '1')
            ->where('deleted_status', '0')
            ->select(['demo_address','id','abstract','is_display','author','title','img','created_at'])->paginate(10);
       return view('home.resource',compact('resource'));
   }
}
