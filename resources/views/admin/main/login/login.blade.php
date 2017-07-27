<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('config.inc.title') }}后台管理系统</title>
    <link rel="shortcut icon" href="{{asset('/templates/admin/images/Logo_40.png')}}" type="image/x-icon">
    <!-- layui.css -->
    <link href="{{asset('/templates/admin/plugin/layui/css/layui.css')}}" rel="stylesheet" />
    <!-- 本页样式 -->
    <link href="{{asset('/templates/admin/css/index.css')}}" rel="stylesheet" />

</head>
<body>
<div class="mask"></div>
<div class="main">
    <h1><span style="font-size: 84px;">{{ config('config.inc.title') }}</span></h1>
    <p id="time"></p>
    <div class="enter">
        Please&nbsp;&nbsp;Click&nbsp;&nbsp;Enter
    </div>
</div>
<!-- layui.js -->
<script src="{{asset('/templates/admin/plugin/layui/layui.js')}}"></script>
<!-- layui规范化用法 -->
<script type="text/javascript">
    layui.config({
        base: '/templates/admin/js/'
    }).use('login');

    function getResponse(data) {
        var $ = layui.jquery;
        $("#result_response").val(data);
    }

</script>
</body>
</html>