@extends('admin.layout.layout')
@section('style')

        <!-- 配置文件 -->
<script type="text/javascript" src="{{asset('templates/admin/plugin/ueditor/ueditor.config.js')}}"></script>
<!-- 编辑器源码文件 -->
<script type="text/javascript" src="{{asset('templates/admin/plugin/ueditor/ueditor.all.js')}}"></script>
@endsection
@section('content')

    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
        <legend>添加关于我</legend>

        {{--<div id="articleContent" class="">--}}
        <form class="layui-form " action="">
            <div class="layui-form-item">
                <label class="layui-form-label">标题</label>
                <div class="layui-input-block">
                    <input type="text" name="title" required="" lay-verify="required" placeholder="请输入标题名称" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">摘要</label>
                <div class="layui-input-block">
                    <input type="text" name="abstract" required="" lay-verify="required" placeholder="请输入摘要" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-field-box">
                <label class="layui-form-label">
                    内容
                </label>
                <div class="layui-input-block" >
                    <textarea id="editor" name="content" style="z-index:0;height:500px;" type="text/plain"></textarea>
                    <script >
                        //实例化编辑器
                        //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
                        var ue = UE.getEditor('editor');
                    </script>
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" lay-filter="formAddAbout" lay-submit>立即发布</button>
                    <button id="Back" type="button" class="layui-btn layui-btn-primary">返回列表</button>
                </div>
        </form>
        </div>
        {{--</div>--}}
    </fieldset>
@endsection
@section('js')
    <script>
        layui.use(['form','layer','upload'], function(){
            $ = layui.jquery;
            var form = layui.form()
                    ,layer = layui.layer
            $('#Back').click( function () {
                layer.load(2);
                location.href = '/admin/about';
            });

            form.on('submit(formAddAbout)', function(data){
                console.log(data)
                var index = layer.load(2);
                $.ajax({
                    type: 'post',
                    url:  '/admin/about',
                    dataType: 'json',
                    data: { '_token':'{{csrf_token()}}',  'json': JSON.stringify(data.field) },
                    success:function (data){
                        // 失败
                        if(data.status == 1){
                            layer.msg(data.msg, {icon: 5,time:1000});
                            //所属名称不能为空
                        }else if(data.status == 0){
                            layer.load(2);
                            layer.msg(data.msg, {icon: 6,time:1000});

                            location.href = '/admin/about';
                        }
                    }
                });
                return false; //阻止表单跳转。如果需要表单跳转，去掉这段即可。
            });

        });

    </script>

@endsection