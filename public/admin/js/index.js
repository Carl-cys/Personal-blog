﻿

layui.define(['element', 'layer', 'form'], function (exports) {
    var form = layui.form();
    var $ = layui.jquery;
    //自定义验证
    form.verify({
        passWord: [/^[\S]{6,12}$/, '密码必须6到12位'],
        account: function (value) {
            if (value.length <= 0 || value.length > 10) {
                return "账号必须1s到10位"
            }
            var reg = /^[a-zA-Z0-9]*$/;
            if (!reg.test(value)) {
                return "账号只能为英文或数字";
            }
        },
        result_response: function (value) {
            if (value.length < 1) {
                return '请点击人机识别验证';
            }
        },
    });
	
	// function getResponse(resp){
     // console.log(resp);  // resp 即验证成功后获取的值
	// }
    //监听登陆提交
	
	
	  // loginHtml += 'header("Access-Control-Allow-Origin: http://mogo.php-garlic.cn")';
	
	// function getResponse(resp){
	// alert(1);
         // console.log(resp);  // resp 即验证成功后获取的值
         // $.ajax({
            // url:'https://captcha.luosimao.com/api/site_verify',
            // type:'post',
            // datatype:'json',
            // async: false,
			// beforeSend: function(xhr){xhr.setRequestHeader('Access-Control-Allow-Origin', 'http://mogo.php-garlic.cn');},
            // data:{
                // 'api_key':'40177878e296e9af803141a89662d464',
                // 'response':resp
            // },
            // success:function(res) {
                // res = JSON.parse(res);
                // console.log(res);
                // alert(1);
            // }
        // });
    // }
    form.on('submit(login)', function (data) {
	
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var index = layer.load(1);
        console.log(data);
        // $.ajax({
            // type: 'post',
            // url : '/admin/login',
            // data: {'username':data.field.account, 'pass': data.field.password, 'machine':data.field.luotest_response},
            // success:function(data){
                // console.log(data);
            // }
        // });
		

		
		
		
        //setTimeout(function () {
        //    //模拟登陆
        //    layer.close(index);
        //    if (data.field.account != 'lyblogscn' || data.field.password != '111111') {
        //        layer.msg('账号或者密码错误', { icon: 5 });
        //    } else {
        //        layer.msg('登陆成功，正在跳转......', { icon: 6 });
        //        layer.closeAll('page');
        //        setTimeout(function () {
        //            location.href = "../html/main.html";
        //        }, 1000);
        //    }
        //}, 400);
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
        loginHtml += '<input type="text" name="account" lay-verify="account" placeholder="请输入账号" value="lyblogscn" autocomplete="off" class="layui-input">';
        loginHtml += '</div>';
        loginHtml += '</div>';
        loginHtml += '<div class="layui-form-item">';
        loginHtml += '<label class="layui-form-label">密码</label>';
        loginHtml += '<div class="layui-input-inline pm-login-input">';
        loginHtml += '<input type="password" name="password" lay-verify="passWord" placeholder="请输入密码" value="111111" autocomplete="off" class="layui-input">';
        loginHtml += '</div>';
        loginHtml += '</div>';
        loginHtml += '<div class="layui-form-item">';
        loginHtml += '<label class="layui-form-label">人机验证</label>';
        loginHtml += '<div class="layui-input-inline pm-login-input">';
        loginHtml +='<div class="l-captcha" data-callback="getResponse" data-site-key="be12cbdec9ef5bb8bb491ca96f9edd85">  </div> ';
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

        //loginHtml += '</form>';

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

