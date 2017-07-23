<?php

namespace App\Http\Controllers\Home;

use App\Models\Article;
use App\Models\Figure;
use App\Models\Links;
use App\Models\Navigation;
use App\Models\Notice;
use App\Models\PersonalInfo;
use App\Models\Resource;
use App\Models\TimeLine;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index( Request $request )
    {
        //文章列表
        $articlelist = $this->articleSorting( 'created_at', 'desc' );
        //热文排行
        $articleclicks= $this->articleSorting( 'clicks', 'desc' );
        //最近分享
        $resource = $this->resource();
        //一路走来时间
        $timeline = $this->timeLine();
        //友情链接
        $links = $this->links();
        //博主信息
        $info = $this->personalInfo();
        //获取公告
        $notice = $this->notice();
        //图片加格言
       $figure =  Figure::select([ 'url','motto', 'img', 'id' ])->get();
        $cate = [];
        foreach($articlelist as $v){
            $cate[] = $this->getCateNameByCateId($v->cate_id);
        }
        return view( 'home.index', compact('cate', 'request', 'figure', 'links', 'info', 'articlelist', 'articleclicks', 'resource', 'timeline', 'notice') );
    }

    /**
     * 获取分类名称
     * @param $id
     * @return string
     */
    public function getCateNameByCateId($id)
    {
        if($id == 0 ){
            return '顶级分类';
        }

        $cate = \App\Models\Category::find($id);

        if(empty($cate)){

            return '无';

        }else{

            return $cate->cate_name;

        }
    }
    /**
     *  公告
     */
    public function notice()
    {
        $notice = Notice::take(4)->get();
        return $notice;
    }
    /**
     * 博主信息
     * @return mixed
     */
    public function personalInfo()
    {
       $info = PersonalInfo::select(['name', 'profile', 'address', 'img'])->first();
        return $info;
    }
    /**
     * 友情链接
     * @return mixed
     */
    public function links()
    {
        $links = Links::select(['name','order','link'])
            ->orderBy('order', 'desc')
            ->get();
        return $links;
    }
    /**
     * 一路走来
     * @return mixed
     */
    public function timeLine()
    {
        $timeline = TimeLine::select(['title','id','created_at'])
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();
        return $timeline;
    }
    /** 最近分享
     * @return mixed
     */
    public function resource()
    {
        $resource = Resource::where('deleted_status', '=', 0)
            ->orderBy( 'created_at','desc' )
            ->select(['title','id','download_url','created_at'])
            ->take(4)->get();

        return $resource;
    }
    /**
     * 获取文章排序
     * @param $field
     * @param $order
     * @return mixed
     */
    public function articleSorting( $field, $order )
    {
        $article = Article::where('deleted_status', '=', 0)
            ->orderBy($field, $order)
            ->select(['cate_id','id', 'abstract','title','created_at','deleted_status','author','img'])
            ->get();
        return $article;
    }
}

