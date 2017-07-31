<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UpdateStaicController extends Controller
{
    public function updateStatic( Request $request )
    {
        if($request->input('id')){
            if(is_file('./index.html')){
                @unlink('./index.html');
                    if (is_dir('./templates/static')) {
                        $this->delFile('./templates/static/detail');
                        $this->delFile('./templates/static/about');
                        $this->delFile('./templates/static/resource');
                        $this->delFile('./templates/static/timeline');
                        $this->delFile('./templates/static/article');
                        return $data = [
                            'status' => '1',
                            'msg' => '删除成功'
                        ];
                    }
            } else {
                return $data = [
                    'status' => '0',
                    'msg'    => '删除失败'
                ];
            }

        }
    }

    /*
     * 删除指定目录下的文件，不删除目录文件夹
     **/
    public function delFile($dirName){

        if(file_exists($dirName) && $handle=opendir($dirName)){
            while(false!==($item = readdir($handle))){
                if($item!= "." && $item != ".."){
                    if(file_exists($dirName.'/'.$item) && is_dir($dirName.'/'.$item)){
                        $this->delFile($dirName.'/'.$item);
                    }else{
                        if(unlink($dirName.'/'.$item)){
                            return true;
                        }
                    }
                }
            }
            closedir( $handle);
        }
    }
}