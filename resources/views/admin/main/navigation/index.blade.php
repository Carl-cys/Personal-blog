@extends('admin.layout.layout')

{{--@yield('title', '文章管理')--}}

@section('style')
    <link rel="stylesheet" type="text/css" href="{{asset('/templates/admin/css/ajaxmodify.css')}}">
    <script src="{{asset('/templates/admin/js/ajaxmodify.js')}}" type="text/javascript"></script>
    <style>
        .layui-btn-small {
            padding: 0 15px;
        }

        .layui-form-checkbox {
            margin: 0;
        }

        tr td:not(:nth-child(0)),
        tr th:not(:nth-child(0)) {
            text-align: center;
        }

        #dataConsole {
            text-align: center;
        }


    </style>
@endsection

@section('formsearch')

    <fieldset id="dataConsole" class="layui-elem-field layui-field-title"  style="">
        <legend>控制台</legend>
        <div class="layui-field-box">
            <div id="articleIndexTop">
                <form class="layui-form layui-form-pane" action="">
                    <div class="layui-form-item" style="margin:0;margin-top:15px;">
                        <div class="layui-inline">
                            <label class="layui-form-label">关键词</label>
                            <div class="layui-input-inline">
                                <input type="text" name="keyword" autocomplete="off" value="{{$request->keyword}}" class="layui-input">
                            </div>
                            <div class="layui-input-inline" style="width:auto">
                                <button class="layui-btn" lay-submit lay-filter="formSearch">搜索</button>
                            </div>
                        </div>
                        <div class="layui-inline">
                            <div class="layui-input-inline" style="width:auto">
                                <a id="addNav" style="text-decoration: none;" href="{{url('/admin/navigation/create')}}" class="layui-btn layui-btn-normal">添加导航</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </fieldset>
@endsection
@section('content')
    <fieldset id="category" class="layui-elem-field layui-field-title sys-list-field" >
        <legend style="text-align:center;">导航列表</legend>
        <div class="layui-field-box">
            <!--内容区域 ajax获取-->
            <table style="" class="layui-table" lay-even="">
                <thead>
                <tr>
                    <th style="width: 80px">ID</th>
                    <th style="width: 300px">导航名称</th>
                    <th style="width: 300px">导航url</th>
                    <th style="width: 500px">导航描述</th>
                    <th style="width: 100px">导航排序</th>
                    <th colspan="2">操作</th>
                </tr>
                </thead>
                <tbody>

                @foreach($navs as $key=> $nav)
                    <tr>
                        <td>{{$nav->id}}</td>

                        <td>{{$nav->title}}</td>

                        <td>{{$nav->url}}</td>

                        <td>{{$nav->desc}}</td>

                        <td>
                            <form class="layui-form" action="" id="orderid">
                                <input onkeyup="this.value=this.value.replace(/[^\d]/g,'')" type="text"  name="order" onchange="changeTableVal('order','mogo_navigation','{{$nav->id}}','{{url('/admin/getAjaxMod')}}',this)" value="{{$nav->order}}"  size="1">
                            </form>
                        </td>

                        <td>
                            <a id="editNav" href="{{url('/admin/navigation/'.$nav->id.'/edit')}}">
                                <button class="layui-btn layui-btn-small layui-btn-normal">
                                    <i class="layui-icon">&#xe642;</i>
                                </button> </a>
                        </td>
                        <td>
                            {{--<a href="{{url('/admin/category/'.$cate->id.'')}}">--}}
                            <button onclick="cate_del(this,'{{$nav->id}}')" class="layui-btn layui-btn-small layui-btn-danger"><i class="layui-icon">&#xe640;</i>
                            </button>
                            {{--</a>--}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="container" style="">
                <div class="row">
                    <div class="col-md-8 col-md-offset-4">
                        {{--{{$specs->links()}}--}}
                        {!! $navs->appends($request->only(['keyword']))->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </fieldset>
@endsection

@section('js')
    <script src="{{asset('templates/admin/plugin/layui/layui.js')}}"></script>
    <script>
        layui.use(['form','layer'], function(){
            $ = layui.jquery;
            var form = layui.form()
                    ,layer = layui.layer
            $('#addNav').click( function () {
                layer.load(2);
            });
            $('#editNav').click( function () {
                layer.load(2);
            });
        });
        /*-删除*/
        function cate_del(obj,id){
            layer.confirm('确认要删除吗？',function(index){
                //发异步删除数据
                var index = layer.load(2);
                $.ajax({
                    type: 'post',
                    url:  '{{url('/admin/navigation/')}}'+'/'+id,
                    dataType: 'json',
                    data: { '_token':'{{csrf_token()}}', '_method': 'DELETE', 'id': id },
                    success:function (data){
                        if(data.status == 0){
                            //传参数错误
                            layer.msg(data.msg, {icon: 5,time:1000});
                            layer.close( index );

                        } else if(data.status == 1){
                            //删除成功
                            layer.msg(data.msg,{icon:1,time:1000});
                            $(obj).parents("tr").remove();
                            layer.close( index );
                        } else {
                            //删除失败
                            layer.msg(data.msg, {icon: 5,time:1000});
                            layer.close( index );
                        }
                    }
                });

            });
        }

    </script>
@endsection