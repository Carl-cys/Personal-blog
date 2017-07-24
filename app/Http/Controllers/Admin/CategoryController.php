<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * @return  view    商品分类列表页
     */
    public function index(Request $request)
    {
        //分页查询以keyword为搜索关键字
        $cate = Category::select(DB::raw('*, concat(path,",",id) as paths '))->orderBy('paths', 'asc')
            ->where(function($query) use ($request){
                //关键字
                $keyword = $request->input('keyword');
                //检测参数
                if(!empty($keyword)){
                    $query->where('cate_name','like','%'.$keyword.'%');
                }
            })->paginate(10);
        $catearr = [];
        //获取父类名称
        foreach($cate as $v){
            $catearr[] = $this->getCateNameByCateId($v->parent_id);
        }
        //遍历数组 调整分类名称
        $cates =  self::trer($cate);
        if(!empty($cates)){
            return view('admin.main.category.index', compact('cates','request','catearr'));
        }
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
     * 添加数据
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        //插入数据
        $data = self::tree($request);
        if( $data ){
            //保存
            if ( DB::table('category')->insert($data) ) {

                $data = [
                    'status' => 0,
                    'msg'    => '添加成功'
                ];
            } else {
                $data = [
                    'status' => 1,
                    'msg'    => '添加失败'
                ];
            }
        } else {
            //没有数据就404
            abort(404);
        }
        return $data;
    }

    /**
     *
     * @param   $request    array   获取请求头信息
     */
    public function create()
    {
        //商品分类添加
        $cates = self::getCates();
        if(!$cates){
            abort(404);
        }
        return view('admin.main.category.create', compact('cates'));
    }

    /**
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show()
    {

    }

    /**
     * @return  view    分类修改页
     */
    public function edit( $id )
    {
        if( $id ){
            $info = Category::find($id);
            if(!$info){
                abort(404);
            }
            //pid路径添加
            $cates = self::getCates();

            return view('admin.main.category.edit',compact('cates','info'));
        } else {
            //http不存在就跳转404
            abort(404);
        }

    }

    /**
     * update   更新修改操作
     *
     * @param   $request    array   获取请求头信息
     *
     * @return  未定义
     */
    public function update(Request $request, $id)
    {
        //插入数据
        $data = self::tree($request);

        if( $id ){
            //保存
            if(Category::where('id', $id)->update($data)){

                $data = [
                    'status' => 0,
                    'msg'    => '修改成功'
                ];

            } else {
                $data = [
                    'status' => 1,
                    'msg'    => '修改失败'
                ];
            }
        } else {
            //不存在就跳转

            abort(404);
        }

        return $data;

    }

    /**
     * 分类删除
     * @param Request $request
     * @param $id 删除id
     * @return int 返回给页面的ajax
     */
    public function destroy(Request $request, $id)
    {
       if(!$id){
          return $data = [
               'status' => 0,
               'msg'    => '请刷新页面后重试'
           ];
       }
        //分类删除id
        $cates = Category::findOrFail($id);

        $row = Category::where('path', 'like', '%'.$id.'%')->get();

        if(!$row->count()){

            Category::destroy([$id]);
            //没数据返回给页面ajax
            $data = [
                'status' => 2,
                'msg'    => '删除成功'
            ];
        } else {
            //有子类的不能删除返回给ajax做判断
            $data = [
                'status' => 1,
                'msg'    => '删除失败啦！检查有无子类'
            ];
        }
        return $data;
    }

    /**
     * 分类区别层级
     * @return mixed $cates
     */
    public function getCates()
    {
        //归类
        $cates = Category::select(DB::raw('*, concat(path,",",id) as paths '))->orderBy('paths')->get();

        return self::trer($cates);

    }

    /**
     *  遍历数组 调整分类名称
     * @param $cates
     * @return mixed
     */
    public function trer($cates){
        //遍历数组 调整分类名称
        foreach ($cates as $key => $value) {
            //判断当前的分类是几级分类
            $tmp = count(explode(',', $value->path)) - 1;
            $prefix = str_repeat('├──', $tmp);
            $value->cate_name = $prefix . $value->cate_name;
        }
        return $cates;
    }

    /**
     * 添加数据和更新数据
     * @param Request $request
     * @return array $data
     */
    public function tree(Request $request)
    {
        //清除put和csfr_field的请求
        $data = json_decode($request->json,true);

        if( array_key_exists('_token', $data) ||  array_key_exists('_method', $data) ){
            unset($data['_token']);
            unset($data['_method']);
        }
        $category = new Category();
//        dump($data);
        //如果顶级分类，pid和level都是0
        if ($data['parent_id'] == '0') {
            $data['path'] = '0';
        } else {
            //如果不是顶级分类
            //读取父级分类的信息
            $info = Category::find($data['parent_id']);

            $data['path'] = $info->path . ',' . $info->id;
        }
        if(!empty($data['cate_name']) ){
            $category->cate_name = $data['cate_name'];
        } else {
            $data = [
                'status' => 3,
                'msg'    => '分类名称不能为空'
            ];
            return $data;
        }
//        dd($data);
        $category->parent_id = $data['parent_id'];
        $category->path = $data['path'];
        $category->cate_desc = $data['cate_desc'];
        return $data;
    }
}
