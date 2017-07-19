@extends('admin.layout.layout')
@section('content')

    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
        <legend>编辑友情</legend>
        <div class="layui-field-box">
            {{--<div id="articleContent" class="">--}}
            <form class="layui-form " action="">
                <div class="layui-form-item">
                    <label class="layui-form-label">名称</label>
                    <div class="layui-input-block">
                        <input type="text" value="{{$link->name}}" name="name" required="" lay-verify="required" placeholder="请输入名称" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">URL</label>
                    <div class="layui-input-block">
                        <input type="text"value="{{$link->link}}" name="link" lay-verify="required" placeholder="请输入URL" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">排序</label>
                    <div class="layui-input-block">
                        <input type="text" value="{{$link->order}}" name="order" lay-verify="required" placeholder="请输入排序" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button class="layui-btn" lay-filter="formEditLink" lay-submit>立即发布</button>
                        <button id="articleBack" type="button" class="layui-btn layui-btn-primary">返回列表</button>
                    </div>
                    <input type="hidden" name="id" value="{{$link->id}}">
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
                layer.load(2);
                location.href = '/admin/links';
            });

            form.on('submit(formEditLink)', function(data){
                var index = layer.load(2);
                $.ajax({
                    type: 'post',
                    url:  '/admin/links/'+data.field.id,
                    dataType: 'json',
                    data: { '_token':'{{csrf_token()}}', '_method':'PUT' ,  'json': JSON.stringify(data.field) },
                    success:function (data){
                        // 失败
                        if(data.status == 0){
                            //失败
                            layer.msg(data.msg, {icon: 5,time:1000});
                            layer.close( index );
                        }else if(data.status == 2){
                            //重名了
                            layer.msg(data.msg, {icon: 5,time:1000});
                            layer.close( index );

                        }else if(data.status == 1){
                            //添加成功
                            layer.msg(data.msg, {icon: 6,time:1000});

                            location.href = '/admin/links';
                        }
                    }
                });
                return false; //阻止表单跳转。如果需要表单跳转，去掉这段即可。
            });
        });

    </script>

@endsection