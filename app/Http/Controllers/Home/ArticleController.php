<?php

namespace App\Http\Controllers\Home;

use App\Models\Article;
use App\Models\Category;
use App\Models\Figure;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    public function article( Request $request )
    {

        if($request->route('category') == 'category' && $request->route('id') != ''){

            $article = Article::where('deleted_status', '=', 0)
                ->where('cate_id', '=', $request->route('id'))
                ->select(['title','clicks','content','author','created_at','id','img','abstract','cate_id'])
                ->take(10)->get();

        }else if($request->route('category') == '' && $request->route('id') == ''){

            $article = Article::where('deleted_status', '=', 0)
                ->select(['title','clicks','content','author','created_at','id','img','abstract','cate_id'])
                ->take(10)->get();

        }else{
            abort(404);
        }
        $cate = [];
        foreach($article as $v){
            $cate[] = Category::getCateNameByCateId($v->cate_id);
        }

        //图片加格言
        $figure =  Figure::figure();
        //判断是否存在
//        if( is_file( "./static/article/article.html" ) ){
//            //存在就读取静态文件
//            return file_get_contents("./static/article/article.html");
//
//        } else {
//            //不存在就保存为静态文件
//            $articlestaic = view('home.article', compact('article', 'request','figure', 'cate'))->__toString();
//
//            file_put_contents("./static/article/article.html" , $articlestaic );
//
//            return view('home.article', compact('article', 'request','figure', 'cate'));
//        }
        return view('home.article', compact('article', 'request','figure', 'cate'));
    }

}
