<?php

namespace App\Http\Controllers\Home;

use App\Models\Article;
use App\Models\Category;
use App\Models\Figure;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\XunSearchController;

class ArticleController extends XunSearchController
{

	public function search( Request $request )
	{
		
		$key = $request->input('keywords');
		
		$xs = new \XS(config_path('mogo.ini'));
		
		$doc = $this->doSearch($key);
		
		$article = $doc['result'];
		$pageBtn = $doc['pageBtn'];
		// dd($doc);
		  
		$cate = [];
        foreach($article as $v){
            $cate[] = Category::getCateNameByCateId($v['cate_id']);
        }

        //图片加格言
        $figure =  Figure::figure();
		
		return view('home.article', compact('pageBtn','article', 'request','figure', 'cate'));

	}
	
	
		
    public function article( Request $request )
    {
		// $articleroute = $request->url();
		// dd($articleroute);
        if($request->route('category') == 'category' && $request->route('id') != ''){

            $article = Article::where('deleted_status', '=', 0)
                ->where('cate_id', '=', $request->route('id'))
                ->select(['title','clicks','content','author','created_at','id','img','abstract','cate_id','deleted_status'])
                ->take(10)->get();

        }else if($request->route('category') == '' && $request->route('id') == ''){

            // $article = Article::where('deleted_status', '=', 0)
                // ->select(['title','clicks','content','author','created_at','id','img','abstract','cate_id','deleted_status'])
                // ->take(10)->get();
				$article = Article::articleSorting( 'created_at', 'desc' );

        }else {
            abort(404);
			// echo '123';
			
        }
        $cate = [];
        foreach($article as $v){
            $cate[] = Category::getCateNameByCateId($v->cate_id);
        }
		//搜索的名字
		$searchcate = Category::getCateNameByCateId($request->route('id'));
        //图片加格言
        $figure =  Figure::figure();
        //判断是否存在
//        if( is_file( "./templates/static/article/article.html" ) ){
//            //存在就读取静态文件
//            return file_get_contents("./templates/static/article/article.html");
//
//        } else {
//            //不存在就保存为静态文件
//            $articlestaic = view('home.article', compact('article', 'request','figure', 'cate'))->__toString();
//
//            file_put_contents("./templates/static/article/article.html" , $articlestaic );
//
//            return view('home.article', compact('article', 'request','figure', 'cate'));
//        }
        return view('home.article', compact('searchcate','article', 'request','figure', 'cate'));
    }

}
