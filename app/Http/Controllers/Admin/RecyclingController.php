<?php

namespace App\Http\Controllers\Admin;

use App\Models\Resource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RecyclingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request )
    {
        $recycling = Resource::select()->orderBy('id', 'desc')
            ->where( 'deleted_status', '=', 1 )
            ->where(function($query) use ($request){
                //关键字
                $keyword = $request->input('keyword');
                //检测参数
                if(!empty($keyword)){
                    $query->where('title','like','%'.$keyword.'%');
                }
            })->paginate(10);
        $cate = [];
        foreach($recycling as $v){
            $cate[] = $this->getCateNameByCateId($v->cate_id);
        }
        return view('admin.main.recycling.index', compact( 'request', 'recycling', 'cate' ));
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
        if($res->img){
            unlink('.'.$res->img);
        }

        if(Resource::destroy([$id])){
            //删除成功
            $data = [
                'status' => 1,
                'msg'    => '彻底删除成功'
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
