<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Mogo后台管理系统</title>
    <link rel="shortcut icon" href="{{asset('/admin/images/Logo_40.png')}}" type="image/x-icon">
    <!-- layui.css -->
    <link href="{{asset('/admin/plugin/layui/css/layui.css')}}" rel="stylesheet" />
    <!-- 本页样式 -->
    <link href="{{asset('/admin/css/index.css')}}" rel="stylesheet" />

</head>
<body>
<div class="mask"></div>
<div class="main">
    <h1><span style="font-size: 84px;">M</span><span style="font-size:30px;">ogo</span></h1>
    <p id="time"></p>
    <div class="enter">
        Please&nbsp;&nbsp;Click&nbsp;&nbsp;Enter
    </div>
</div>
<!-- layui.js -->
<script src="{{asset('/admin/plugin/layui/layui.js')}}"></script>
<!-- layui规范化用法 -->
<script type="text/javascript">
    layui.config({
        base: '/admin/js/'
    }).use('index');
	
    function getResponse(data) {
        var $ = layui.jquery;
        $("#result_response").val(data);
    }

</script>
<script type="text/javascript">
        function systemTime() {
            //获取系统时间。
            var dateTime = new Date();
            var year = dateTime.getFullYear();
            var month = dateTime.getMonth() + 1;
            var day = dateTime.getDate();
            var hh = dateTime.getHours();
            var mm = dateTime.getMinutes();
            var ss = dateTime.getSeconds();

            //分秒时间是一位数字，在数字前补0。
            mm = extra(mm);
            ss = extra(ss);

            //将时间显示到ID为time的位置，时间格式形如：19:18:02
            document.getElementById("time").innerHTML = year + "-" + month + "-" + day + " " + hh + ":" + mm + ":" + ss;
            //每隔1000ms执行方法systemTime()。
            setTimeout("systemTime()", 1000);
        }

        //补位函数。
        function extra(x) {
            //如果传入数字小于10，数字前补一位0。
            if (x < 10) {
                return "0" + x;
            }
            else {
                return x;
            }
        }
        systemTime();
    </script>
</body>
</html>