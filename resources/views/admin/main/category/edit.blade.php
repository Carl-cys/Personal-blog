@extends('admin.layout.layout')
@section('content')
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 50px;">
        <legend>编辑分类</legend>
        <div class="layui-field-box">
            {{--<div id="articleContent" class="">--}}
            <form class="layui-form " action="">
                <div class="layui-form-item">
                    <label class="layui-form-label">分类</label>
                    <div class="layui-input-block">
                        <select name="parent_id" lay-filter="aihao">
                            <option value="0">顶级分类</option>
                            @foreach($cates as $cate)
                                <option value="{{$cate->id}}" @if($info->parent_id == $cate->id) selected @endif>{{$cate->cate_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">名称</label>
                    <div class="layui-input-block">
                        <input type="text" value='{{$info->cate_name}}' name="cate_name" required="" lay-verify="required" placeholder="请输入分类名称" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">备注</label>
                    <div class="layui-input-block">
                        <input type="text" value='{{$info->cate_desc}}' name="cate_desc" lay-verify="required" placeholder="请输入备注" autocomplete="off" class="layui-input">
                    </div>
                </div>

                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button class="layui-btn" lay-filter="formEditCate" lay-submit>立即发布</button>
                        {{--<a href="{{url('admin/category')}}">--}}
                        <button id="articleBack" type="button" class="layui-btn layui-btn-primary">返回列表</button>
                        {{--</a>--}}
                    </div>
                    <input type="hidden" name="id" value="{{$info->id}}">
            </form>
        </div>
        {{--</div>--}}
    </fieldset>
@endsection
@section('js')
    <script>

        layui.use(['form','layer'], function(){
            $ = layui.jquery;
            var form = layui.form()
                    ,layer = layui.layer
            $('#articleBack').click( function () {

                layer.load(1);
                history.back(-1)
            });

            form.on('submit(formEditCate)', function(data){
                var index = layer.load(2);
                $.ajax({
                    type: 'post',
                    url:  "/admin/category/"+data.field.id,
                    dataType: 'json',
                    data: { '_token':'{{csrf_token()}}', '_method':'PUT' ,  'json': JSON.stringify(data.field)},
                    success:function (data){
                        // 失败
                        if(data.status == 1){
                            layer.msg(data.msg, {icon: 5,time:1000});
                            //所属名称不能为空
                        } else if(data.status == 2){
                            layer.msg(data.msg, {icon: 5,time:1000});
                        } else if(data.status == 0){
                            layer.msg(data.msg, {icon: 6,time:1000});
                            location.href = '/admin/category';
                        }

                    }
                });
                return false; //阻止表单跳转。如果需要表单跳转，去掉这段即可。
            });
        });

    </script>
@endsection