<?php

namespace App\Http\Controllers\Home;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DetailController extends Controller
{
    public function detail( Request $request )
    {

        $id = $request->route('id');
        //获取文章内容
        $detail = $this->articleDetail($id);
        //获取顶级分类
        return view('home.detail', compact('detail'));

    }


    /**
     * 获取文章
     * @param $id
     * @return mixed
     */
    public function articleDetail( $id )
    {
        $detail = Article::find( $id, ['title','clicks','content','author','created_at','id', 'keyword', 'abstract'] );
        return $detail;
    }
}
