<?php

namespace App\Http\Controllers\Admin;

use App\Models\Users;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request )
    {
//        dd();
        $users = Users::select()
            ->where(function($query) use ($request){
                //关键字
                $keyword = $request->input('keyword');
                //检测参数
                if(!empty($keyword)){
                    $query->where('nickname','like','%'.$keyword.'%');
                }
            })->paginate(10);

        return view('admin.main.users.index', compact( 'request', 'users' ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.main.users.create');
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
        $res = Users::where('nickname', '=', $data['nickname'])
            ->OrWhere('email', '=', $data['email'])
            ->first();
        if($res){
            $suc = [
                'status' => 0,
                'msg'    => '管理员名称或邮箱已存在，请重新输入！'
            ];
            return $suc;
        }
        $user = new Users();
        if(!$data['img']){
            $suc = [
                'status' => 1,
                'msg'    => '请上传头像啦'
            ];
            return $suc;
        }
//        dd($data['img']);
        $user->pic   = $data['img'];
        $user->email   = $data['email'];
        $user->nickname   = $data['nickname'];
        $user->password = bcrypt($data['password']);
        if( $user->save() ){
            $suc = [
                'status' => 2,
                'msg'    => '添加成功啦'
            ];

        } else {
            $suc = [
                'status' => 3,
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
        $user = Users::find( $id, ['id','nickname','email','password','pic'] );
        return view('admin.main.users.edit', compact('user'));
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
//        dd(Auth::user());
        $data = json_decode( $request->json, true );
//        if( $data['nickname'] == Auth::user()->nickname ){
//            //一旦失败清除所有认证后加入到用户 session 的数据
//            Auth::logout();
//            return redirect('/admin/login');
//        }
        $res = Users::where('nickname', '=', $data['nickname'])
            ->where('id', '!=', $id )
            ->first();
        //判断是否重名
        if($res){
            $suc = [
                'status' => 0,
                'msg'    => '管理员名称或邮箱已存在，请重新输入！'
            ];
            return $suc;
        } else {

            $user = Users::find($id);
            //判断密码
            if($data['password'] != ''){
                $user->password = bcrypt($data['password']);
            } else {
                $user->password = $user->password ;
            }
            //判断图片并删除原来的图片
            if( $user->pic !== $data['img'] ){
                if($user->pic !== ''){

                    unlink('.'.$user->pic);
                }
                $user->pic      = $data['img'];
            } else {
                $user->pic      = $data['img'];
            }

            $user->nickname = $data['nickname'];
            $user->email = $data['email'];
            //执行添加
            if( $user->save() ){
                if( $data['nickname'] == Auth::user()->nickname ){
                //一旦失败清除所有认证后加入到用户 session 的数据
                    return $suc = [
                        'status' => 4,
                        'msg'    => '修改成功,请重新登录'
                    ];
                }
                $suc = [
                    'status' => 2,
                    'msg'    => '修改成功啦'
                ];

            } else {
                $suc = [
                    'status' => 3,
                    'msg'    => '修改失败啦'
                ];
            }
            return $suc;
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
