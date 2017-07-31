<?php

namespace App\Http\Controllers\Home;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DetailController extends Controller
{
    public function detail( Request $request )
    {

        $id = $request->route('id');
        if( !$id ){
            abort(404);
        }
        //获取文章内容
        $detail = $this->articleDetail($id);
		
		//判断session是否存在
		if ( session('newNum') != $id) {
			$detail->where('id', $id)->update(['clicks' => $detail->clicks + 1]);
			session(['newNum' => $id]);
		}
        //判断是否存在
        if( is_file( "./templates/static/detail/".$id.".html" ) ){
            //存在就先读
            return file_get_contents("./templates/static/detail/".$id.".html");

        } else {

            $detailstaic = view('home.detail', compact('detail'))->__toString();

            file_put_contents("./templates/static/detail/".$id.".html" , $detailstaic );

            return view('home.detail', compact('detail'));

        }

    }
    /**
     * 获取文章
     * @param $id
     * @return mixed
     */
    public function articleDetail( $id )
    {
        $detail = Article::find( $id, ['title','clicks','content','author','created_at','id', 'keyword', 'abstract'] );
        return $detail;
    }
}
