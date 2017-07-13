<script src="//captcha.luosimao.com/static/js/api.js"></script>
<link href="{{asset('/admin/plugin/layui/css/layui.css')}}" rel="stylesheet" />
<script src="{{asset('/admin/plugin/layui/layui.js')}}"></script>
<form class="layui-form" action="">
    <div class="layui-form-item">
        <label class="layui-form-label">账号</label>
        <div class="layui-input-inline pm-login-input">
            <input type="text" name="account" lay-verify="account" placeholder="请输入账号" value="lyblogscn" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">密码</label>
        <div class="layui-input-inline pm-login-input">
            <input type="password" name="password" lay-verify="passWord" placeholder="请输入密码" value="111111" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">人机验证</label>
        <div class="layui-input-block">
            <div class="l-captcha" data-site-key="be12cbdec9ef5bb8bb491ca96f9edd85"></div>
            {{--<input type="password" name="password" lay-verify="passWord" placeholder="人机验证，百度螺丝帽" value="" autocomplete="off" class="layui-input">--}}
        </div>
    </div>
    <div class="layui-form-item" style="margin-top:25px;margin-bottom:0;">
        <div class="layui-input-block">
            <button class="layui-btn" style="width:230px;" lay-submit="" lay-filter="login">立即登录</button>
        </div>
    </div>
</form>
