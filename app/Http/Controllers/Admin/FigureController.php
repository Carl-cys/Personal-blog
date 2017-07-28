<?php

namespace App\Http\Controllers\Admin;

use App\Models\Figure;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FigureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request )
    {
        $figure = Figure::select()->orderBy('id', 'desc')
            ->where(function($query) use ($request){
                //关键字
                $keyword = $request->input('keyword');
                //检测参数
                if(!empty($keyword)){
                    $query->where('url','like','%'.$keyword.'%');
                }
            })->paginate(10);
        return view('admin.main.figure.index', compact( 'request', 'figure' ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.main.figure.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = json_decode( $request->json, true );

        $figure = new Figure();
        $figure->url       = $data['url'];
        $figure->motto     = $data['motto'];
        $figure->img       = $data['img'];

        //添加
        if( $figure->save() ){

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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!$id){
            abort(404);
        }
        $figure = Figure::find( $id, ['motto', 'url', 'id', 'img'] );
        return view('admin.main.figure.edit', compact( 'figure' ));
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
        $data = json_decode( $request->json, true );

        $figure = Figure::find($id);
        $figure->url       = $data['url'];
        $figure->motto     = $data['motto'];
//        $res->img           = $data['img'];

        if( $figure->img !== $data['img'] ){
            if( is_file($figure->img) ){
                unlink('.'.$figure->img);
            }
            $figure->img    = $data['img'];
        }

        if( $figure->save() ){

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

        $figure = Figure::find($id);

        if($figure->img){
            unlink('.'.$figure->img);
        }

        if($figure::destroy([$id])){
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
