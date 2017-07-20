<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    /**
     * 显示列表页
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index( Request $request )
    {
        $articles = Article::select()->orderBy('id', 'desc')
            ->where( 'deleted_status', '=', 0 )
            ->where(function($query) use ($request){
                //关键字
                $keyword = $request->input('keyword');
                //检测参数
                if(!empty($keyword)){
                    $query->where('title','like','%'.$keyword.'%');
                }
            })->paginate(10);
        $cate = [];
        foreach($articles as $v){
            $cate[] = $this->getCateNameByCateId($v->cate_id);
        }
        return view('admin.main.article.index', compact( 'request', 'articles', 'cate' ));
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
    /**
     * 显示添加页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $cates = Category::where('parent_id', '=', '0')->get();

        return view('admin.main.article.create', compact('cates'));
    }

    /**
     * 文章添加
     * @param Request $request
     * @return array 返回给ajax
     */
    public function store(Request $request)
    {
        $res = json_decode( $request->json, true );

        $article = new Article();
        $article->cate_id       = $res['cate_id'];
        $article->title         = $res['title'];
        $article->abstract      = $res['abstract'];
        $article->content       = $res['content'];
        $article->img           = $res['img'];
        $article->author        = $res['author'];
        //如果存在就代表选中了
        if(array_key_exists('read_ecommend', $res)){
                //赋值
                $article->read_ecommend  = 1;
        }
        if(array_key_exists('read_top', $res)){

            $article->read_top  = 1;
        }

        //添加
        if( $article->save() ){

            $data = [
                'status' => 0,
                'msg'    => '添加成功啦'
            ];

        } else {

            $data = [
                'status' => 1,
                'msg'    => '添加失败啦'
            ];
        }
        return $data;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * 显示修改页面
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
       if(!$id){
           abort(404);
       }
        $cates = Category::where('parent_id', '=', '0')->get();
        $articleinfo  = Article::find($id);
        return view('admin.main.article.edit', compact('cates', 'articleinfo'));
    }

    /**
     * 更新文章
     * @param Request $request
     * @param $id
     * @return array 返回给ajax
     */
    public function update(Request $request, $id)
    {
        $res = json_decode( $request->json, true );

        $article = Article::find($id);
        $article->cate_id       = $res['cate_id'];
        $article->title         = $res['title'];
        $article->abstract      = $res['abstract'];
        $article->content       = $res['content'];
        $article->author        = $res['author'];

        if( $article->img !== $res['img'] ){
            if($article->img !== ''){
                unlink('.'.$article->img);
            }

            $article->img       = $res['img'];
        }
        //如果存在就代表选中了
        if( array_key_exists('read_ecommend', $res) ){
            //赋值
            $article->read_ecommend  = 1;
        }
        if( array_key_exists('read_top', $res) ){

            $article->read_top  = 1;
        }
        if( $article->save() ){

            $data = [
                'status' => 0,
                'msg'    => '修改成功啦'
            ];

        } else {

            $data = [
                'status' => 1,
                'msg'    => '修改失败啦'
            ];
        }
        return $data;

    }

    /**
     * 删除文章
     * @param $id
     */
    public function destroy($id)
    {
        if(!$id){
            return $data = [
                'status' => 0,
                'msg'    => '请刷新页面后重试'
            ];
        }

        $status = Article::find( $id );

        $status->deleted_status = 1;
        if( $status->save() ){
            $data = [
                'status' => 1,
                'msg'    => '添加回收站成功'
            ];
        } else {
            $data = [
                'status' => 0,
                'msg'    => '添加回收站失败'
            ];
        }

        return $data;
    }
}
