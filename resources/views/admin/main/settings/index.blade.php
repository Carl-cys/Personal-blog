@extends('admin.layout.layout')
@section('style')

    <!-- 配置文件 -->
    <script type="text/javascript" src="{{asset('templates/admin/plugin/ueditor/ueditor.config.js')}}"></script>
    <!-- 编辑器源码文件 -->
    <script type="text/javascript" src="{{asset('templates/admin/plugin/ueditor/ueditor.all.js')}}"></script>
    <style>
        .x-red {
            color: red;
        }
        .layui-form-switch{
            width: 50px;
        }
    </style>
@endsection
@section('content')

    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
        <legend>网站信息</legend>
        {{--<div id="articleContent" class="">--}}
        <div class="layui-tab layui-tab-brief" lay-filter="docDemoTabBrief">
            @if(session('success'))
                <div class="alert alert-success">
                    {{session('success')}}
                </div>
            @elseif(session('error'))
                <div class="alert alert-danger">
                    {{session('error')}}
                </div>

            @endif
            <ul class="layui-tab-title">
                <li class="layui-this">网站设置</li>
                <li>邮件设置</li>
                <li>关闭网站</li>
                <li>其它设置</li>
            </ul>
            <div class="layui-tab-content">
                <div class="layui-tab-item layui-show">
                    <form class="layui-form layui-form-pane" action="{{url('admin/settings')}}" method="post">
                        {{csrf_field()}}
                        <div class="layui-form-item">
                            <label class="layui-form-label" style="width:100px;">
                                <span class='x-red'>*</span>网站名称
                            </label>
                            <div class="layui-input-block">
                                <input type="text" name="title" autocomplete="off" placeholder="控制在25个字、50个字节以内" class="layui-input" value="{{ $data['title'] }}">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label" style="width:100px;">
                                <span class='x-red'>*</span>关键词
                            </label>
                            <div class="layui-input-block">
                                <input type="text" name="keyword" autocomplete="off" placeholder="5个左右,8汉字以内,用英文,隔开" class="layui-input" value="{{ $data['keyword'] }}">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label" style="width:100px;">
                                <span class='x-red'>*</span>描述
                            </label>
                            <div class="layui-input-block">
                                <input type="text" name="desc" autocomplete="off" placeholder="空制在80个汉字，160个字符以内" class="layui-input" value="{{ $data['desc'] }}">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label" style="width:100px;">
                                <span class='x-red'>*</span>底部文本
                            </label>
                            <div class="layui-input-block">
                                <input type="text" name="text" autocomplete="off" placeholder="空制在80个汉字，160个字符以内" class="layui-input" value="{{ $data['text'] }}">
                            </div>
                        </div>

                        <div class="layui-form-item">
                            <label class="layui-form-label" style="width:100px;">
                                <span class='x-red'>*</span>底部版权信息
                            </label>
                            <div class="layui-input-block">
                                <input type="text" name="copyright" autocomplete="off" placeholder="&copy; 2016 X-admin" class="layui-input" value="{{ $data['copyright'] }}">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label" style="width:100px;">
                                <span class='x-red'>*</span>备案号
                            </label>
                            <div class="layui-input-block">
                                <input type="text" name="number" autocomplete="off" placeholder="京ICP备00000000号" class="layui-input" value="{{ $data['number'] }}">
                            </div>
                        </div>
                        <div class="layui-form-item layui-form-text">
                            <label class="layui-form-label">
                                <span class='x-red'>*</span>统计代码
                            </label>
                            <div class="layui-input-block">
                                <textarea placeholder="请输入内容" name='countcode' class="layui-textarea">{{ $data['countcode'] }}</textarea>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <button class="layui-btn">
                                保存
                            </button>
                        </div>
                    </form>
                    <div style="height:100px;"></div>
                </div>

                <div class="layui-tab-item">
                    <form class="layui-form layui-form-pane" action="email" method="post">
                        {{csrf_field()}}
                        <div class="layui-form-item">
                            <label class="layui-form-label" style="width:100px;">
                                <span class='x-red'>*</span>邮件发送模式
                            </label>
                            <div class="layui-input-block">
                                <input type="text" name="send_mode" autocomplete="off" placeholder="" class="layui-input" value="{{ $data['send_mode'] }}">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label" style="width:100px;">
                                <span class='x-red'>*</span>SMTP服务器
                            </label>
                            <div class="layui-input-block">
                                <input type="text" name="smtp_server" autocomplete="off" placeholder="smtp.qq.com" class="layui-input" value="{{ $data['smtp_server'] }}">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label" style="width:100px;">
                                <span class='x-red'>*</span>SMTP 端口
                            </label>
                            <div class="layui-input-block">
                                <input type="text" name="smtp_port" autocomplete="off" placeholder="25" class="layui-input" value="{{ $data['smtp_port'] }}">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label" style="width:100px;">
                                <span class='x-red'>*</span>邮箱帐号
                            </label>
                            <div class="layui-input-block">
                                <input type="text" name="smtp_user" autocomplete="off" placeholder="邮件服务商申请的帐号" class="layui-input" value="{{ $data['smtp_user'] }}">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label" style="width:100px;">
                                <span class='x-red'>*</span>邮箱密码
                            </label>
                            <div class="layui-input-block">
                                <input type="text" name="smtp_pwd" autocomplete="off" placeholder="邮件服务商申请的密码" class="layui-input" value="{{ $data['smtp_pwd'] }}">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label" style="width:100px;">
                                <span class='x-red'>*</span>收件邮箱地址
                            </label>
                            <div class="layui-input-block">
                                <input type="text" name="recipient_email" autocomplete="off" placeholder="" class="layui-input" value="{{ $data['recipient_email'] }}">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <button class="layui-btn" >
                                保存
                            </button>
                        </div>
                    </form>
                </div>
                <div class="layui-tab-item">
                    <form class="layui-form" action="{{ url('admin/webswitch') }}" method="post">
                        {{csrf_field()}}
                        <div class="layui-form-item">
                            <label class="layui-form-label" style="width: auto;">网站开关</label>
                            <div class="layui-input-block">
                                <input type="radio" name="webswitch" value="Y" title="开" {{ $data['webswitch'] == 'Y' ? 'checked':'' }}>
                                <input type="radio" name="webswitch" value="N" title="关" {{ $data['webswitch'] == 'N' ? 'checked':'' }}>
                            </div>
                        </div>

                        <div class="layui-form-item">
                            <label for="L_repass" class="layui-form-label">
                            </label>
                            <button class="layui-btn" lay-submit lay-filter="open">
                                保存
                            </button>
                        </div>
                    </form>
                </div>
                <div class="layui-tab-item">
                    <form class="layui-form layui-form-pane" action="{{url('admin/custom')}}" method="post">
                        {{csrf_field()}}
                        <div class="layui-form-item">
                            <label class="layui-form-label" style="width:100px;">
                                <span class='x-red'>*</span>自定义变量名
                            </label>
                            <div class="layui-input-inline">
                                <input type="text" name="name" autocomplete="off" placeholder="自定义变量名"
                                       class="layui-input">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label" style="width:100px;">
                                <span class='x-red'>*</span>自定义变量值
                            </label>
                            <div class="layui-input-inline">
                                <input type="text" name="value" autocomplete="off" placeholder="自定义变量值"
                                       class="layui-input">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <button class="layui-btn">
                                保存
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            //Demo
            layui.use('form', function(){
                var form = layui.form();

                //监听提交
                form.on('submit(formDemo)', function(data){
                    layer.msg(JSON.stringify(data.field));
                    return false;
                });
            });
        </script>
        </div>
        {{--</div>--}}
    </fieldset>
@endsection
@section('js')
    <script src="{{asset('templates/admin/plugin/layui/layui.js')}}"></script>
    <script>
        layui.use(['element', 'layer','form'], function () {
            $ = layui.jquery;//jquery
            lement = layui.element();//面包导航
            layer = layui.layer;//弹出层
            form = layui.form()

            var open;
            form.on('switch(open)', function(data){
                // 当值为开启时，当未选中的时候才是open为1,否则为0;
                if(data.value==0){
                    if(data.elem.checked == false){
                        open = 1;
                    }else {
                        open = 0;
                    }
                }else{
                    if(data.elem.checked == true){
                        open = 0;
                    }else {
                        open = 1;
                    }
                }
//                console.log(data.elem); //得到checkbox原始DOM对象
//                console.log(data.elem.checked); //开关是否开启，true或者false
//                console.log(data.value); //开关value值，也可以通过data.elem.value得到
            });

            {{--form.on('submit(open)', function (data) {--}}
                {{--console.log(data);--}}
                {{--//发异步，把数据提交给php--}}
                {{--$.ajax({--}}
                    {{--type: "POST",--}}
                    {{--url: '{{url('admin/setchange')}}',--}}
                    {{--dataType: 'json',--}}
                    {{--cache: false,--}}
                    {{--data: {'open': open,'_token': "{{csrf_token()}}"},--}}
                    {{--success: function (data){--}}
                        {{--if(data){--}}
                            {{--layer.alert("保存成功", {icon: 6,time:1000});--}}
                        {{--}else {--}}
                            {{--layer.alert("保存失败", {icon: 5,time:1000});--}}
                        {{--}--}}
                    {{--}--}}
                {{--});--}}
            {{--});--}}
            //监听提交
//            form.on('submit(*)', function (data) {
//                console.log(data);
//                //发异步，把数据提交给php
//                layer.alert("保存成功", {icon: 6});
//                return false;
//            });

        });
    </script>
@endsection