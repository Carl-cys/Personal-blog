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
     * 流加载首页
     * @param Request $request
     * @return mixed
     */
    public function flow( Request $request )
    {
        $request->input('currentIndex');     

        $flow = Article::where('deleted_status', '=', '0')
        ->orderBy( 'created_at', 'desc' )
		->paginate(5);
			
		$articlelist = Article::articleSorting( 'created_at', 'desc' );
		
        $cate = [];
		
		$str = '';
		foreach($flow as $key => $list){
			 
			$cate[] = Category::getCateNameByCateId($list->cate_id);
												 
					$str .= '<div class="article shadow">';
					$str .= '<div class="article-left">';
					$str .= '<img style="width: 100%;" width="200" height="130" lay-src="'. $list->img.'" alt="'. $list->title.'" />';
					$str .= '</div>';
					$str .= '<div class="article-right">';
					$str .= '<div class="article-title">';
					$str .= '<a href="/home/detail/'.$list->id.'">'. $list->title.'</a>';
					$str .= '</div>';
					$str .= '<div class="article-abstract">'.$list->abstract.'';						
					$str .= '</div>';
					$str .= '</div>';
					$str .= '<div class="clear"></div>';
					$str .= '<div class="article-footer">';
					$str .= '<span><i class="fa fa-clock-o"></i>&nbsp;&nbsp;'.date( 'Ymd', strtotime($list['created_at'])).'</span>';
					$str .= '<span class="article-author"><i class="fa fa-user"></i>&nbsp;&nbsp;'.$list->author.'</span>';
					$str .= '<span><i class="fa fa-tag"></i>&nbsp;&nbsp;<a href="#">'.@$cate[$key].'</a></span>';
					$str .= '<span class="article-viewinfo"><i class="fa fa-eye"></i>&nbsp;'.$list->clicks.'</span>';
					$str .= '<span class="article-viewinfo"><i class="fa fa-commenting"></i>&nbsp;</span>';
					$str .= '</div>';
					$str .= '</div>';
		 }     
							
        return  $data =   [
            'flow' => $str,  
			'data' => $flow			
        ];
	}
}

