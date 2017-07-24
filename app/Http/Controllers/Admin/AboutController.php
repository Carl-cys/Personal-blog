<?php

namespace App\Http\Controllers\Admin;

use App\Models\About;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request )
    {
        $about= About::select()->orderBy('id', 'desc')
            ->where(function($query) use ($request){
                //关键字
                $keyword = $request->input('keyword');
                //检测参数
                if(!empty($keyword)){
                    $query->where('title','like','%'.$keyword.'%');
                }
            })->paginate(10);
        return view('admin.main.about.index', compact( 'request', 'about' ));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.main.about.create');
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

        $about = new About();

        $about->title   = $data['title'];
        $about->abstract   = $data['abstract'];
        $about->content = $data['content'];

        if( $about->save() ){

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
        $about = About::find($id, ['title', 'content', 'id', 'abstract']);
        return view('admin.main.about.edit', compact('about'));
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

        $about = About::find($id);
        $about->title = $data['title'];
        $about->content = $data['content'];
        $about->abstract = $data['abstract'];
        if( $about->save() ){

            $suc = [
                'status' => 0,
                'msg'    => '修改成功啦'
            ];

        } else {

            $suc = [
                'status' => 1,
                'msg'    => '修改失败啦'
            ];
        }
        return $suc;
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
