<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>数据列表页面@yield('title')</title>
    <!-- layui.css -->
    <link rel="stylesheet" href="{{asset('templates/admin/plugin/bootstrap/css/bootstrap.css')}}">
    <link href="{{asset('templates/admin/plugin/layui/css/layui.css')}}" rel="stylesheet" />
    <script src="{{asset('templates/admin/plugin/jq/jquery-1.10.2.min.js')}}"></script>
    <script src="{{asset('templates/admin/plugin/layui/layui.js')}}"></script>
    @yield('style')
</head>
<body style="overflow:scroll;overflow-x:hidden">

    @show
        {{--搜索--}}
    @yield('formsearch')

    {{--内容--}}
    @yield('content')
    {{--js--}}
    @yield('js')
    <!-- layui.js -->

<!-- layui规范化用法 -->

</body>
</html>