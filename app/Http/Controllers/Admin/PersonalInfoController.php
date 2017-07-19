<?php

namespace App\Http\Controllers\Admin;

use App\Models\PersonalInfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PersonalInfoController extends Controller
{
    /**
     * 显示博主信息
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index( Request $request )
    {
        $perinfo = PersonalInfo::select()->orderBy('id', 'desc')
            ->where(function($query) use ($request){
                //关键字
                $keyword = $request->input('keyword');
                //检测参数
                if(!empty($keyword)){
                    $query->where('name','like','%'.$keyword.'%');
                }
            })->paginate(10);
        return view( 'admin.main.personalinfo.index', compact('perinfo', 'request') );
    }

    /**
     * 显示添加页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view( 'admin.main.personalinfo.create');
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

        $info = new PersonalInfo();
        $info->name         = $data['name'];
        $info->profile      = $data['profile'];
        $info->address      = $data['address'];
        $info->img          = $data['img'];

        //添加
        if( $info->save() ){

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
        $resinfo = PersonalInfo::find($id);
        return view( 'admin.main.personalinfo.edit', compact('resinfo'));
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

        $info = PersonalInfo::find($id);
        $info->name         = $data['name'];
        $info->profile      = $data['profile'];
        $info->address      = $data['address'];
//        $info->img          = $data['img'];

        if( $info->img !== $data['img'] ){
            unlink('.'.$info->img);
            $info->img       = $data['img'];
        }

        if( $info->save() ){

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

        $info = PersonalInfo::find($id);
        if($info->img){
            unlink('.'.$info->img);
        }

        if(PersonalInfo::destroy([$id])){
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
