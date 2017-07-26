@extends('admin.layout.layout')
@section('style')

        <!-- 配置文件 -->
<script type="text/javascript" src="{{asset('templates/admin/plugin/ueditor/ueditor.config.js')}}"></script>
<!-- 编辑器源码文件 -->
<script type="text/javascript" src="{{asset('templates/admin/plugin/ueditor/ueditor.all.js')}}"></script>
@endsection
@section('content')

    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
        <legend>添加文章</legend>
        <div class="layui-field-box">
            {{--<div id="articleContent" class="">--}}
            <form class="layui-form " action="">
                <div class="layui-form-item">
                    <label class="layui-form-label">标题</label>
                    <div class="layui-input-block">
                        <input type="text" name="title" required="" lay-verify="required" placeholder="请输入标题名称" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">分类</label>
                    <div class="layui-input-block">
                        <select name="cate_id" lay-filter="aihao" lay-verify="required">
                            <option value="">-请选择-</option>

                            @foreach($cates as $cate)
                                <option value="{{$cate->id}}">{{$cate->cate_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">摘要</label>
                    <div class="layui-input-block">
                        <input type="text" name="abstract" required="" lay-verify="required" placeholder="请输入摘要" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">作者</label>
                    <div class="layui-input-block">
                        <input type="text" name="author" required="" lay-verify="required" placeholder="请输入作者" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">关键词</label>
                    <div class="layui-input-block">
                        <input type="text" name="keyword" required=""  placeholder="请输入关键词，以逗号分隔" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item" style="position:relative;">
                    <label class="layui-form-label">封面</label>
                    <div class="layui-input-inline">
                        <input id="articleCoverSrc" name="img" type="hidden">
                        <img id="articleCoverImg" class="img-cover" src="{{asset('/templates/admin/images/cover_default.jpg')}}"  style='border: 1px solid #ddd; margin-left:30px' width="200" alt="封面">
                    </div>

                    <div class="layui-input-inline" style="position:absolute;bottom:0;margin-left: 40px">
                        <input type="hidden" value="{{csrf_token()}}" name="_token">
                        <input type="file" id="articleCoverInput" name="file" class="layui-upload-file">
                        {{--</div>--}}
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">选项</label>
                    <div class="layui-input-block">
                        <input type="checkbox" name="read_top" title="置顶">
                        <input type="checkbox" name="read_ecommend" title="推荐">
                    </div>
                </div>
                <div class="layui-form-item">
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
                        <button class="layui-btn" lay-filter="formAddArticle" lay-submit>立即发布</button>
                        <button id="articleBack" type="button" class="layui-btn layui-btn-primary">返回列表</button>
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
                location.href = '/admin/article';
            });

            form.on('submit(formAddArticle)', function(data){

                var index = layer.load(2);
                $.ajax({
                    type: 'post',
                    url:  '/admin/article',
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

                            location.href = '/admin/article';
                        }
                    }
                });
                return false; //阻止表单跳转。如果需要表单跳转，去掉这段即可。
            });

            var index;
            var token = $("input[name='_token']").val();
            layui.upload({
                url: '/admin/uploadCover/article',
                elem: '#articleCoverInput',
                method: 'post',
                before: function (input) {
                    index = layer.load(1);
                    var data = {'_token':token};
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