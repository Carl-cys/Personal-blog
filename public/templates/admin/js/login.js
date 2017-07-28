layui.define(['element', 'layer', 'form'], function (exports) {
    var form = layui.form();
    var $ = layui.jquery;
    //自定义验证
    form.verify({
        passWord: [/^[\S]{5,12}$/, '密码必须5到12位'],
        account: function (value) {
            if (value.length <= 0 || value.length > 10) {
                return "账号必须1s到10位"
            }
            var reg = /^[a-zA-Z0-9]*$/;
            if (!reg.test(value)) {
                return "账号只能为英文或数字";
            }
        },
        //人机验证返回来的token
        result_response: function (value) {
           if (value.length < 1) {
               return '请点击人机识别验证';
           }
        },
    });
	

    //监听登陆提交
    form.on('submit(login)', function (data) {
	
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var index = layer.load(2);
         $.ajax({
             type: 'post',
             url : '/admin/signIn ',
             data: {'json' : JSON.stringify(data.field)},
             success:function( data ){
                 // 状态 1, 信息：致命错误,请刷新网页后重试
                 // 状态 2, 信息：密码错误
                 // 状态 3, 信息：该管理员已被禁止登录,请联系管理员！
                 // 状态 4, 信息：该管理员不存在！
                 // 状态 5, 信息：登录成功！
                 //返回来先关闭index层
                 //layer.close(index);
                 if( data.status == 1 ){

                     layer.msg( data.msg, {icon: 5} );
                     layer.close( index );
                 } else if( data.status == 2 ){

                     layer.msg(data.msg, {icon: 5});
                     layer.close( index );
                 } else if( data.status == 3 ){

                     layer.msg(data.msg, {icon: 5});
                     layer.close( index );
                 } else if( data.status == 4 ){

                     layer.msg( data.msg, {icon: 5} );
                     layer.close(index);
                 } else if( data.status == 5 ){
                     //登录成功
                     //layer.msg( data.msg, { icon: 6 } );
                     //关闭所有页面层
                     layer.closeAll( 'page' );
                     location.href = "/admin";
                 }
             }
         });

        return false;
    });
    //检测键盘按下
    $('body').keydown(function (e) {
        if (e.keyCode == 13) {  //Enter键
            if ($('#layer-login').length <= 0) {
                login();
            } else {
                $('button[lay-filter=login]').click();
            }
        }
    });

    $('.enter').on('click', login);

    function login() {
        var loginHtml = ''; //静态页面只能拼接，这里可以用iFrame或者Ajax请求分部视图。html文件夹下有login.html
        loginHtml += '<form class="layui-form" action="">';
        loginHtml += '<div class="layui-form-item">';
        loginHtml += '<label class="layui-form-label">账号</label>';
        loginHtml += '<div class="layui-input-inline pm-login-input">';
        loginHtml += '<input type="text" name="nickname" lay-verify="account" placeholder="请输入账号" autocomplete="off" class="layui-input">';
        loginHtml += '</div>';
        loginHtml += '</div>';
        loginHtml += '<div class="layui-form-item">';
        loginHtml += '<label class="layui-form-label">密码</label>';
        loginHtml += '<div class="layui-input-inline pm-login-input">';
        loginHtml += '<input type="password" name="password" lay-verify="passWord" placeholder="请输入密码" autocomplete="off" class="layui-input">';
        loginHtml += '</div>';
        loginHtml += '</div>';
        loginHtml += '<div class="layui-form-item">';
        loginHtml += '<label class="layui-form-label">人机验证</label>';
        loginHtml += '<div class="layui-input-inline pm-login-input">';
        loginHtml +='<div class="l-captcha" data-callback="getResponse" data-site-key="94f39a9699cb60ed75f6ca73649e14ca">  </div> ';
		loginHtml += '<input type="hidden" id="result_response" name="result_response" lay-verify="result_response">';
        loginHtml += '</div>';
        loginHtml += '</div>';
        loginHtml += '<div class="layui-form-item" style="margin-top:25px;margin-bottom:0;">';
        loginHtml += '<div class="layui-input-block">';
        loginHtml += ' <button class="layui-btn" style="width:230px;" lay-submit="" lay-filter="login">立即登录</button>';
        loginHtml += ' </div>';
        loginHtml += ' </div>';
        loginHtml += '</form>';
        loginHtml += '<script src="//captcha.luosimao.com/static/dist/api.js"></script>';


        layer.open({
            id: 'layer-login',
            type: 1,
            title: false,
            shade: 0.4,
            shadeClose: true,
            area: ['480px', '270px'],
            closeBtn: 0,
            anim: 1,
            skin: 'pm-layer-login',
            content: loginHtml
        });
        layui.form().render('checkbox');
    }
    exports('index', {});
});

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

