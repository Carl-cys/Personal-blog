<?php

namespace App\Http\Controllers\Home;

use App\Models\Article;
use App\Models\Category;
use App\Models\Figure;
use App\Models\Links;
use App\Models\Navigation;
use App\Models\Notice;
use App\Models\PersonalInfo;
use App\Models\Resource;
use App\Models\TimeLine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index( Request $request )
    {
        // 文章列表
		// $redislist = Redis::get('articlelist');
		
		// if( $redislist ){
			
			// $article = Redis::get('articlelist');
			
			// $articlelist = json_decode($article, true);
			
		// } else {
			
			// $articlelist = $this->articleSorting( 'created_at', 'desc' );
		
			// $articlelist = json_decode($article, true);
			
			// Redis::set( 'articlelist', $articlelist );
		// }
        $articlelist = Article::articleSorting( 'created_at', 'desc' );
        //热文排行
        $articleclicks= Article::articleSorting( 'clicks', 'desc' );
        //最近分享
        $resource = Resource::resource();
        //一路走来时间
        $timeline = TimeLine::timeLine();
        //友情链接
        $links = Links::links();
        //博主信息
        $info = PersonalInfo::personalInfo();
        //获取公告
        $notice = Notice::notice();
        //图片加格言
        $figure = Figure::figure();
	   
        $cate = [];
		
        foreach($articlelist as $v){
            $cate[] = Category::getCateNameByCateId($v->cate_id);
        }
		
		//判断是否存在
		if( is_file('./index.html') ){
			//直接读取
		
			return file_get_contents('./index.html');
			
		} else {

			//先保存
			$static = view( 'home.index', compact('cate', 'request', 'figure', 'links', 'info', 'articlelist', 'articleclicks', 'resource', 'timeline', 'notice') )->__toString();
		
			file_put_contents('index.html', $static );
			//返回动态的页面
			 return view( 'home.index', compact('cate', 'request', 'figure', 'links', 'info', 'articlelist', 'articleclicks', 'resource', 'timeline', 'notice') );
			
		}
    }

    /**
     * 获取分类名称
     * @param $id
     * @return string
     */
    public function getCateNameByCateId($id)
    {
        if($id == 0 ){
            return '顶级分类';
        }

        $cate = \App\Models\Category::find($id);

        if(empty($cate)){

            return '无';

        }else{

            return $cate->cate_name;

        }
    }

}

