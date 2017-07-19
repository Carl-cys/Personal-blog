<?php

namespace App\Http\Controllers\Admin;

use App\Models\TimeLine;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TimeLineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request )
    {
        $timeline = TimeLine::select()->orderBy('id', 'desc')
            ->where(function($query) use ($request){
                //关键字
                $keyword = $request->input('keyword');
                //检测参数
                if(!empty($keyword)){
                    $query->where('title','like','%'.$keyword.'%');
                }
            })->paginate(10);

        return view('admin.main.timeline.index', compact( 'request', 'timeline' ));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.main.timeline.create');
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

        $timeline = new TimeLine();

        $timeline->title = $data['title'];
        $timeline->content = $data['content'];

        if( $timeline->save() ){

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
        $timeline = TimeLine::find($id, ['title', 'content','id']);
        return view('admin.main.timeline.edit', compact('timeline'));
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

        $timeline = TimeLine::find($id);
        $timeline->title = $data['title'];
        $timeline->content = $data['content'];
        if( $timeline->save() ){

            $suc = [
                'status' => 0,
                'msg'    => '修改成功啦'
            ];

        } else {

            $suc = [
                'status' => 1,
                'msg'    => '修改失败啦'
            ];
        }
        return $suc;
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
        if(TimeLine::destroy([$id])){
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
