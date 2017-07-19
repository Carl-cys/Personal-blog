<?php

namespace App\Http\Controllers\Admin;

use App\Models\Links;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use phpDocumentor\Reflection\DocBlock\Tags\Link;

class LinksController extends Controller
{
    /**
     * 显示友情链接
     * @param Request $request
     */
    public function index( Request $request )
    {
        $links = Links::select()->orderBy('id', 'desc')
            ->where(function($query) use ($request){
                //关键字
                $keyword = $request->input('keyword');
                //检测参数
                if(!empty($keyword)){
                    $query->where('name','like','%'.$keyword.'%');
                }
            })->paginate(10);
        return view('admin.main.links.index', compact('links','request'));
    }

    /**
     * 显示添加页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.main.links.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $res = json_decode( $request->json, true );

        $links = Links::where( 'name', '=', $res['name'] )->first();

        //如果数据不存在就添加存在就提示
        if( !$links ){
            $link = new Links();
            $link->name = $res['name'];
            $link->link = $res['link'];
            $link->order = $res['order'];
            //执行添加
            if( $link->save() ){
                //成功
                $data = [
                    'status' => 1,
                    'msg'    => '添加成功',
                ];

            } else {
                //失败
                $data = [
                    'status' => 0,
                    'msg'    => '添加失败',
                ];
            }
            return $data;
        } else {
            return $data = [
                'status' => 2,
                'msg'    => '请重新输入啦，名称存在哦！',
            ];
        }
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
     * 显示编辑页面
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        //不存在就返回404界面
        if(!$id){
            abort(404);
        }
        $link = Links::find($id, ['id','name','link','order']);
        return view('admin.main.links.edit', compact('link'));
    }

    /**
     * 更新操作
     * @param Request $request
     * @param $id
     * @return array
     */
    public function update(Request $request, $id)
    {
        //如果没有id直接跳转404
        if( !$id ){
            abort(404);
        }
        //获取ajax请求
        $res = json_decode( $request->json, true );

        //查询是否重名
        $link = Links::where( 'name', '=', $res['name'] )->where( 'id','!=',$id )->first();
        //如果数据不存在就添加存在就提示
        if( !$link ){
            //更新
            $linkurl = Links::where( 'id', '=', $id )->update( $res );
            //成功
            if( $linkurl ){
                $data = [
                    'status' => 1,
                    'msg'    => '修改成功',
                ];
            } else {
                $data = [
                    'status' => 0,
                    'msg'    => '修改失败',
                ];
            }
            return $data;
        } else {
            //返回给ajax
            return $data = [
                'status' => 2,
                'msg'    => '请重新输入啦，名称存在哦！',
            ];
        }
    }

    /**
     * 删除
     * @param $id
     * @return array
     */
    public function destroy($id)
    {
        if(!$id){
            return $data = [
                'status' => 0,
                'msg'    => '请刷新页面后重试'
            ];
        }
        if(Links::destroy([$id])){
            //删除成功
            $data = [
                'status' => 1,
                'msg'    => '删除成功'
            ];
        } else {
            //删除失败
            $data = [
                'status' => 2,
                'msg'    => '删除失败'
            ];
        }
        return $data;
    }
}
