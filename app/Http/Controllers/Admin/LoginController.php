<?php

namespace App\Http\Controllers\Admin;

use App\Models\Users;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    /**
     * 显示登录页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function login()
	{
		return view('admin.main.login.login');
    }

    /**
     * 登录验证
     * 状态 1, 信息：致命错误,请刷新网页后重试
     * 状态 2, 信息：密码错误
     * 状态 3, 信息：该管理员已被禁止登录,请联系管理员！
     * 状态 4, 信息：该管理员不存在！
     * 状态 5, 信息：登录成功！
     * @param Request $request
     * @return array|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
	public function signIn( Request $request )
	{
//        $this->validate($request, [
//            'nickname'      => 'required',
//            'password'      => 'required',
//        ], [
//            'required'      => ':attribute必须填写',
//        ], [
//            'nickname'      => '管理员名称',
//            'password'      => '密码',
//        ]);
        $data = json_decode($request->json);
        //查询是否有这个用户
        $res = Users::where('nickname', $data->nickname)->first();
        if( $res ){
            //状态为启用的
            if( $res->status == 1 ){
                //验证通过
                if( Auth::attempt( ['nickname' => $data->nickname, 'password' => $data->password ] ) ){
                    //登录数量+1
                    $num = $res->login_num + 1;
                    //把上次登录时间存入session
                    $request->session()->put('last_login_ip', $res->last_login_ip);
                    $request->session()->put('last_login_time', $res->last_login_time);
                    $request->session()->put('login_num', $num);

                    //写入登录日志表中
                    //写入登录日志
                    $log = DB::table('admin_log')->insert([
                        'nickname'   => $res->nickname,
                        'user_id'    => $res->id,
                        'status'     => $res->status,
                        'content'    => '登录成功',
                        'login_ip'   => $request->getClientIp(),//客户端ip
                        'login_time' => date('Y-m-d H:i:s'),
                    ]);
                    //判断是否写入成功
                    if ( !$log ) {
                        //一旦失败清除所有认证后加入到用户 session 的数据
                        Auth::logout();
                        return $this->error( 1, '致命错误,请刷新网页后重试');
                    }
                    //验证成功跳转
                    return $this->error( 5, '登录成功啦。。。。');
                }
                //密码错误
                return $this->error( 2, '密码错误');
            }
            //写入登录日志
            $log = DB::table('admin_log')->insert([

                'nickname'   => $res->nickname,
                'user_id'    => $res->id,
                'status'     => $res->status,
                'content'    => '登录失败',
                'login_ip'   => $request->getClientIp(),
                'login_time' => date('Y-m-d H:i:s'),
            ]);

            if ( !$log ) {
                Auth::logout();
                return $this->error( 1, '致命错误,请刷新网页后重试');
            }

            return $this->error( 3, '该管理员已被禁止登录,请联系管理员！');
        }

        return $this->error( 4, '该管理员不存在！');
	}

    /**
     * 返回ajax的信息
     * @param $status  状态码
     * @param $msg     错误内容
     * @return array
     */
    public function error( $status,$msg )
    {
        return $data = [
            'status' => $status,
            'msg' => $msg,
        ];
    }
}
