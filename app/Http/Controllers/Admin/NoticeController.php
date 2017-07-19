<?php

namespace App\Http\Controllers\Admin;

use App\Models\Notice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request )
    {
        $notice = Notice::select()
            ->where(function($query) use ($request){
                //关键字
                $keyword = $request->input('keyword');
                //检测参数
                if(!empty($keyword)){
                    $query->where('name','like','%'.$keyword.'%');
                }
            })->paginate(10);

        return view('admin.main.notice.index', compact( 'request', 'notice' ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.main.notice.create');
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

        $notice = new Notice();

        $notice->name = $data['name'];
        $notice->color = $data['color'];
        $notice->content = $data['content'];

        if( $notice->save() ){

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
        $notice = Notice::find($id, ['name', 'color', 'content','id']);
        return view('admin.main.notice.edit', compact('notice'));
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

        $notice = Notice::find($id);
        $notice->name = $data['name'];
        $notice->color = $data['color'];
        $notice->content = $data['content'];

        if( $notice->save() ){

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
        if(Notice::destroy([$id])){
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
