<?php

namespace App\Http\Controllers\Admin;

use App\Models\AdminLogo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminLogoController extends Controller
{
    /**
     * 显示日志页面
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index( Request $request )
    {

        $logos= AdminLogo::select()->orderBy('id', 'desc')
            ->where(function($query) use ($request){
                //关键字
                $keyword = $request->input('keyword');
                //检测参数
                if(!empty($keyword)){
                    $query->where('nickname','like','%'.$keyword.'%');
                }
            })->paginate(10);
        return view( 'admin.main.adminlogo.index', compact('logos','request') );
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
     * 日志
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

        if(AdminLogo::destroy([$id])){
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
