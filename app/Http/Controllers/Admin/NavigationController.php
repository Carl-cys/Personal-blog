<?php

namespace App\Http\Controllers\Admin;

use App\Models\Navigation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\CommonController;

class NavigationController extends Controller
{   

    protected $msg;

    public function __construct()
    {
        $this->msg = new CommonController;

    }

    /**
     * 前台首页
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index( Request $request )
    {
        $navs = Navigation::select()->orderBy('order', 'desc')
            ->where(function($query) use ($request){
                //关键字
                $keyword = $request->input('keyword');
                //检测参数
                if(!empty($keyword)){
                    $query->where('title','like','%'.$keyword.'%');
                }
            })->paginate(10);
       return view( 'admin.main.navigation.index', compact( 'request', 'navs') );
    }

    /**
     * 显示导航页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view( 'admin.main.navigation.create' );
    }

    /**
     * 添加导航
     * @param Request $request
     * @return array ajax返回值
     */
    public function store(Request $request)
    {
        $res = json_decode( $request->json, true );

        if ( !$res['title'] ) {
            return $this->msg->msg(0, '名称不能为空！');

        }elseif ( !$res['url'] ) {
            return $this->msg->msg->msg(0, 'url不能为空！');

        }elseif ( !$res['desc'] ) {
            return $this->msg->msg(0, '描述不能为空！');

        }

        $navquery = Navigation::where( 'title', '=', $res['title'] )->first();

        //如果数据不存在就添加存在就提示
        
        if( !$navquery ){
            $nav = new Navigation();
            $nav->title = $res['title'];
            $nav->url = $res['url'];
            $nav->desc = $res['desc'];
            $nav->order = $res['order'];
            //执行添加
            if( $nav->save() ){
                //成功
                $data = $this->msg->msg(1, '添加成功');

            } else {
                //失败
                $data = $this->msg->msg(0, '添加失败');
            }
            return $data;

        } else {
            return $this->msg->msg(2, '请重新输入啦，名称存在哦！');

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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //不存在就返回404界面
        if(!$id){
            abort(404);
        }
        $nav = Navigation::find($id);
        return view( 'admin.main.navigation.edit', compact('nav') );

    }

    /**
     * 更新数据并判断是否重名
     * @param Request $request
     * @param $id
     * @return array 返回给ajax的数据
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
        $navquery = Navigation::where( 'title', '=', $res['title'] )->where( 'id','!=',$id )->first();
        //如果数据不存在就添加存在就提示
        if( !$navquery ){
            //更新
            $navup = Navigation::where( 'id', '=', $id )->update( $res );
            //成功
            if( $navup ){
                $data = $this->msg->msg(1, '修改成功');
            } else {
                $data = $this->msg->msg(0, '修改失败');
            }
            return $data;
        } else {
            //返回给ajax
            return $data = $this->msg->msg(2, '请重新输入啦，名称存在哦！');

        }
    }

    /**
     * 删除
     * @param $id
     */
    public function destroy($id)
    {
        if(!$id){
            return $this->msg->msg(0, '请刷新页面后重试');
        }
        if(Navigation::destroy([$id])){
          //删除成功
          $data = $this->msg->msg(1, '删除成功');

        } else {
            //删除失败
            $data = $this->msg->msg(2, '删除失败');
        }
        return $data;
    }

}
