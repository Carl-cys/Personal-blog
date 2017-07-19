@extends('admin.layout.layout')
@section('style')

        <!-- 配置文件 -->
<script type="text/javascript" src="{{asset('templates/admin/plugin/ueditor/ueditor.config.js')}}"></script>
<!-- 编辑器源码文件 -->
<script type="text/javascript" src="{{asset('templates/admin/plugin/ueditor/ueditor.all.js')}}"></script>
@endsection
@section('content')

    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
        <legend>添加管理员</legend>

        {{--<div id="articleContent" class="">--}}
        <form class="layui-form " action="">
            <div class="layui-form-item">
                <label class="layui-form-label">用户名</label>
                <div class="layui-input-block">
                    <input type="text" name="nickname" required="" lay-verify="nikename" placeholder="请输入名称" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">密码框</label>
                <div class="layui-input-inline" style="margin-left: 30px">
                    <input type="password" name="password" required lay-verify="pass" placeholder="请输入密码" autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux">辅助文字</div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">邮箱</label>
                <div class="layui-input-block">
                    <input type="email" name="email" required="" lay-verify="required" placeholder="请输入邮箱" autocomplete="off" class="layui-input">
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
                    <button class="layui-btn" lay-filter="formAddUser" lay-submit>立即发布</button>
                    <button id="eBack" type="button" class="layui-btn layui-btn-primary">返回列表</button>
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
            $('#articleBack').click( function () {
                layer.load(2);
                location.href = '/admin/user';
            });
            form.verify({
                nikename: function(value){
                    if(value.length < 5){
                        return '昵称最少5位哦';
                    }
                }
                ,pass:function (value){
                    [/(.+){6,12}$/, '密码必须6到12位']
                }
//                ,repass: function(value){
//                    if($('#L_pass').val()!=$('#L_repass').val()){
//                        return '两次密码不一致';
//                    }
//                }
            });
            form.on('submit(formAddUser)', function(data){

                var index = layer.load(2);
                $.ajax({
                    type: 'post',
                    url:  '/admin/user',
                    dataType: 'json',
                    data: { '_token':'{{csrf_token()}}',  'json': JSON.stringify(data.field) },
                    success:function (data){
                        // 管理员名称或邮箱已存在，请重新输入
                        layer.close( index );
                        if(data.status == 0){

                            layer.msg(data.msg, {icon: 5,time:1000});
                            //请上传头像啦
                        }else if(data.status == 1){
                            layer.msg(data.msg, {icon: 5,time:1000});
                            //添加失败啦
                        }else if(data.status == 3){
                            layer.msg(data.msg, {icon: 5,time:1000});
                            //添加成功啦
                        } else if(data.status == 2){
                            layer.load(2);
                            layer.msg(data.msg, {icon: 6,time:1000});
                            location.href = '/admin/user';
                        }
                    }
                });
                return false; //阻止表单跳转。如果需要表单跳转，去掉这段即可。
            });

            var index;
            var token = $("input[name='_token']").val();
            layui.upload({
                url: '/admin/uploadCover/user',
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