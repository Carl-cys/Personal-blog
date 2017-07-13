<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>数据列表页面@yield('title')</title>
    <!-- layui.css -->
    <link href="{{asset('/admin/plugin/layui/css/layui.css')}}" rel="stylesheet" />
    @yield('style')
</head>
<body>

    @show
    <fieldset id="dataConsole" class="layui-elem-field layui-field-title"  style="display:none;">
        {{--搜索--}}
    @yield('formsearch')

    </fieldset>
    {{--内容--}}
    @yield('content')
    {{--js--}}
    @yield('js')
    <!-- layui.js -->
<script src="{{asset('/admin/plugin/layui/layui.js')}}"></script>
<!-- layui规范化用法 -->
<script type="text/javascript">
    layui.config({
        base: '/admin/js/'
    }).use('datalist');
</script>
</body>
</html>