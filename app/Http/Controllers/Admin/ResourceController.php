<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Resource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ResourceController extends Controller
{
    /**
     * 显示列表页
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index( Request $request )
    {
        $resource = Resource::select()->orderBy('id', 'desc')
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
        foreach($resource as $v){
            $cate[] = $this->getCateNameByCateId($v->cate_id);
        }
        return view('admin.main.resource.index', compact( 'request', 'resource', 'cate' ));
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

        return view('admin.main.resource.create', compact('cates'));
    }

    /**
     * 资源添加
     * @param Request $request
     * @return array 返回给ajax
     */
    public function store(Request $request)
    {
        $data = json_decode( $request->json, true );

        $res = new Resource();
        $res->cate_id       = $data['cate_id'];
        $res->title         = $data['title'];
        $res->abstract      = $data['abstract'];
        $res->demo_address       = $data['demo_address'];
        $res->download_url       = $data['download_url'];
        $res->img           = $data['img'];
        $res->author        = $data['author'];

        //添加
        if( $res->save() ){

            $suc = [
                'status' => 0,
                'msg'    => '添加成功啦'
            ];

        } else {

            $suc = [
                'status' => 1,
                'msg'    => '添加失败啦'
            ];
        }
        return $suc;

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
        $resinfo  = Resource::find($id);
        return view('admin.main.resource.edit', compact('cates', 'resinfo'));
    }

    /**
     * 更新文章
     * @param Request $request
     * @param $id
     * @return array 返回给ajax
     */
    public function update(Request $request, $id)
    {
        $data = json_decode( $request->json, true );

        $res = Resource::find($id);
        $res->cate_id       = $data['cate_id'];
        $res->title         = $data['title'];
        $res->abstract      = $data['abstract'];
        $res->demo_address  = $data['demo_address'];
        $res->download_url  = $data['download_url'];
//        $res->img           = $data['img'];
        $res->author        = $data['author'];

        if( $res->img !== $data['img'] ){
            if($res->img){
                unlink('.'.$res->img);
            }
            $res->img       = $data['img'];
        }

        if( $res->save() ){

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
     * 删除资源
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

        $res = Resource::find($id);

        $res->deleted_status = 1;
        if( $res->save() ){
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
