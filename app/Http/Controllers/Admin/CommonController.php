<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use App\Models\Links;
use App\Models\Navigation;
use App\Models\Resource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class CommonController extends Controller
{
    /**
     * 是否切换ajax请求
     * @param Request $request
     * @return array
     * 详细看org/ajax/ajax.js
     */
    public function getAjaxMod(Request $request)
    {
        $data = $request->all();
//        dd($data);
        //判断表名
        switch($data['tablename']){
            case 'mogo_navigation':
                $public = Navigation::findOrFail($data['id']);
                break;
            case 'mogo_article':
                $public = Article::findOrFail($data['id']);
                break;
            case 'mogo_resource':
                $public = Resource::findOrFail($data['id']);
                break;
            case 'mogo_links':
                $public = Links::findOrFail($data['id']);
                break;
        }

        $fieldname = $data['fieldname'];

        //获取数据库值，并修改
        if($data['val'] == ''){
            switch( $public->$fieldname ){
                //成功
                case '1':
                    $public->$fieldname = 0;
                    break;
                case '0':
                    $public->$fieldname = 1;
                    break;
            }
        } else {
            //onchange 修改排序
            $public->$fieldname = $data['val'] ;
        }
        //保存并返回
        if ( $public->save() ){
            $data = [
                'status' => 1,
                'msg'    => '插入成功',
                'val'    => $public->$fieldname
            ];
        } else {
            $data = [
                'status' => 0,
                'msg' => '插入失败'
            ];
        }
        return $data;
    }

    /**
     * 文件上传
     * @param Request $request
     * @return string
     */
    public function uploadCover( Request $request )
    {
        $routename = $request->route('filename');
        //获取文件名
        if($request->isMethod('post')){
            //获取上传的对象

            $file = Input::file('file');

            if( $file -> isValid() ){ //判断是否存在

                $entension = $file -> getClientOriginalExtension();//上传文件的后缀
                //生成随机命名
                $newName = date('YmdHis').mt_rand(1000,9999).'.'.$entension;
                //移动到uploads文件夹
                $path = $file -> move('Uploads/'.$routename.'/'.date('Ymd'), $newName);
                //拼接路径+文件名
                $filepath = '/Uploads/'.$routename.'/'.date('Ymd').'/' .$newName;
                //返回给视图
                $data = [
                    'status' => 1,
                    'info'   => '成功啦',
                    'path'   =>  $filepath
                ];
                return json_encode($data);
            }
        }
    }
    public function recovery( Request $request )
    {
        $id = $request->input('id');
        $tablename = $request->input('tablename');

        switch( $tablename ){
            case 'mogo_article':
                $public = Article::findOrFail($id);
                break;
            case 'mogo_resource':
                $public = Resource::findOrFail($id);
                break;
            case 'mogo_links':
                $public = Links::findOrFail($id);
                break;
        }

        $public->deleted_status = 0;

        if( $public->save() ){
            $data = [
                'status' => 1,
                'msg'    => '还原成功'
            ];
        } else {
            $data = [
                'status' => 0,
                'msg'    => '还原失败'
            ];
        }
        return $data;
    }

    public function msg($number, $msg)
    {
        $error['status'] = $number;
        $error['msg'] = $msg;
        
        return $error;
    }

}
