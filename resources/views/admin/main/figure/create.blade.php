@extends('admin.layout.layout')
@section('style')
@endsection
@section('content')

    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
        <legend>添加格言与背景</legend>
        <div class="layui-field-box">
            {{--<div id="articleContent" class="">--}}
            <form class="layui-form " action="">
                <div class="layui-form-item">
                    <label class="layui-form-label">格言</label>
                    <div class="layui-input-block">
                        <input type="text" name="motto" required="" lay-verify="required" placeholder="请输入格言" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">路由</label>
                    <div class="layui-input-block">
                        <input type="text" name="url" required="" lay-verify="required" placeholder="请输入路由名称" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item" style="position:relative;">
                    <label class="layui-form-label">封面</label>
                    <div class="layui-input-inline">
                        <input id="articleCoverSrc" name="img" type="hidden">
                        <img id="articleCoverImg" class="img-cover" src="{{asset('/templates/admin/images/cover_default.jpg')}}"  style='border: 1px solid #ddd; margin-left:30px' width="200" alt="封面">
                    </div>
                    <div class="layui-input-inline" style="position:absolute;bottom:0;margin-left: 40px">
                        <input type="file" id="articleCoverInput" name="file" class="layui-upload-file">
                        {{--</div>--}}
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button class="layui-btn" lay-filter="formAddFigure" lay-submit>立即发布</button>
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
                location.href = '/admin/figure';
            });

            form.on('submit(formAddFigure)', function(data){

                var index = layer.load(2);
                $.ajax({
                    type: 'post',
                    url:  '/admin/figure',
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

                            location.href = '/admin/figure';
                        }
                    }
                });
                return false; //阻止表单跳转。如果需要表单跳转，去掉这段即可。
            });

            var index;
            var token = $("input[name='_token']").val();
            layui.upload({
                url: '/admin/uploadCover/figure',
                elem: '#articleCoverInput',
                method: 'post',
                before: function (input) {
                    index = layer.load(1);
                },
                success: function (res) {
                    layer.close(index);
                    if(res.status == 1){
                        $('#articleCoverSrc').val(res.path);
                        $("#articleCoverImg").attr('src', res.path);
                        layer.msg(res.info);
                    }
                }
            });
        });

    </script>

@endsection