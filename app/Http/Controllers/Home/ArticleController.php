<?php

namespace App\Http\Controllers\Home;

use App\Models\Article;
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
            $cate[] = $this->getCateNameByCateId($v->cate_id);
        }
        //图片加格言
        $figure =  Figure::select([ 'url','motto', 'img', 'id' ])->get();

        return view('home.article', compact('article', 'request','figure', 'cate'));
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
