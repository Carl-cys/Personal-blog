@extends('Home.layouts.layout')

@section('style')

@endsection

@section('content')
    <section id="intro">
        <div class="blog-body">
            <div class="blog-container">
                <blockquote class="layui-elem-quote sitemap layui-breadcrumb shadow" style="visibility: visible;">
                    <a href="home.html" title="网站首页">网站首页<span class="layui-box">&gt;</span></a>
                    <a href="article.html" title="文章专栏">文章专栏<span class="layui-box">&gt;</span></a>
                    <a><cite>基于layui的laypage扩展模块！</cite></a>
                </blockquote>
                <div class="blog-main">
                    <div class="blog-main-left">
                        <!-- 文章内容（使用Kingeditor富文本编辑器发表的） -->
                        <div class="article-detail shadow">
                            <div class="article-detail-title">
                                基于laypage的layui扩展模块（pagesize.js）！
                            </div>
                            <div class="article-detail-info">
                                <span>编辑时间：2017/3/18 17:30:22</span>
                                <span>作者：Absolutely</span>
                                <span>浏览量：12</span>
                            </div>
                            <div class="article-detail-content">
                                <p style="text-align:center;">
                                    <strong><span style="font-size:18px;">小赌为快</span></strong>
                                </p>
                                <p style="text-align:center;">
                                    <strong>
                                    <span style="font-size:18px;">
                                        <br />
                                    </span>
                                    </strong>
                                </p>
                                <p style="text-align:center;">
                                    <img src="http://www.lyblogs.cn/kindeditor/attached/image/20170318/20170318175743_4625.gif" width="100%" height="auto" title="pagesize演示" alt="pagesize演示" />
                                </p>
                                <p style="text-align:left;">
                                    <br />
                                </p>
                                <hr />
                                <p>
                                    <br />
                                </p>
                                <div style="text-align:center;">
                                    &nbsp; &nbsp; <span style="color:#EE33EE;">前言</span>：如果你没使用过layui框架或是laypage模块，那么请忽略这篇文章！
                                </div>
                                <hr />
                                <p>
                                    <br />
                                </p>
                                <p>
                                    &nbsp;&nbsp;&nbsp;&nbsp;pagesize.js是博主写的一个基于laypage的layui扩展模块。扩展了laypage目前未有的一个页容量控制功能！
                                </p>
                                <p>
                                    &nbsp;&nbsp;&nbsp;&nbsp;由于目前layui的分页laypage模块并没有控制页容量的功能（layui 2.0不知道会不会有），所以我针对我自己的后台管理系统制作了这样一个功能！
                                </p>
                                <p>
                                    &nbsp; &nbsp; 起初想着自己用，就简简单单的写了个方法，后来想着layui2.0发布日期还不知道，不如把这个方法做成模块分享！
                                </p>
                                <p>
                                    &nbsp; &nbsp; pageszie.js采用layui定义模块的方法定义，所以你可以以layui加载其他模块的方式加载它，<span style="color:#EE33EE;">前提</span>是你把pagesize.js放在/layui/lay/modules/目录下面。
                                </p>
                                <p>
                                    <br />
                                </p>
                                <p>
                                    &nbsp; &nbsp; 加载方法如下：
                                </p>
<pre class="prettyprint linenums lang-js">layui.use('pagesize',function(){
    var pagesize = layui.pagesize();
});</pre>
                                <p>
                                    &nbsp;&nbsp; &nbsp; 它主要提供两个功能，一个是原有的laypage上渲染一段控制页容量的html代码，另一个是点击确定的时候返回所确定的新的页容量。
                                </p>
                                <p>
                                    <br />
                                </p>
                                <p>
                                    &nbsp; &nbsp; 使用方法如下：
                                </p>
<pre class="prettyprint linenums lang-js">//注意，这个方法须在laypage(seetiongs)方法执行之后，也就是laypage渲染之后！否则可能会出现意外
pagesize(laypageId, pageSize).callback(function (newPageSize) {
    //这个回调函数是在指定新的页容量后触发
    //并返回新的页容量
    //你可以在这里使用新的页容量重新获取分页数据！
});</pre>
                                &nbsp;&nbsp; &nbsp;<span style="color:#EE33EE;">参数说明</span>：
                                <p>
                                    &nbsp; &nbsp; <span style="color:#337FE5;"><strong>laypageId</strong></span>：laypage容器元素的id属性，同于laypage(settings)的cont属性，由于作之前没看laypage的cont属性还可以传dom或jquery对象，所以这里只支持元素id属性！
                                </p>
                                <p>
                                    &nbsp;&nbsp;&nbsp;&nbsp;<strong><span style="color:#337FE5;">pageSize</span></strong>：当前页容量，用于将当前页容量显示在界面上！
                                </p>
                                <p>
                                    <br />
                                </p>
                                <p>
                                    &nbsp;&nbsp;&nbsp;&nbsp;该功能是我后台分页的时候扩展的一个功能，但我又想将它分享出来，于是做成了layui扩展模块。<br />
                                    &nbsp;&nbsp;&nbsp;&nbsp;由于它起初针对我个人后台的分页定制的扩展功能，所以我只测试了我分页的写法是能实现的，并不知道大家的分页写法是否能用！<br />
                                    &nbsp;&nbsp;&nbsp;&nbsp;如不能用，请参考我后台的分页写法！<br />
                                    &nbsp;&nbsp;&nbsp;&nbsp;后台暂时没有源码，没时间整理，所以请自行到后台查看！
                                </p>
                                <hr />
                                <p>
                                    <br />
                                </p>
                                <p>
                                    &nbsp; &nbsp; 点赞不落阁：<a href="http://fly.layui.com/case/2017/" target="_blank"><span style="color:#337FE5;">点击前往</span></a>&nbsp; &nbsp; 完整演示请看后台：<span><a href="http://www.lyblogs.cn/admin" target="_blank"><span style="color:#337FE5;">点击前往</span></a></span>&nbsp; &nbsp; pagesize.js下载地址：<a href="https://pan.baidu.com/s/1kVK8UhT" target="_blank"><span style="color:#337FE5;">点击前往</span></a>
                                </p>
                                <hr />
                                &nbsp; &nbsp; 出自：不落阁
                                <p>
                                    &nbsp; &nbsp; 地址：<a href="http://www.lyblogs.cn" target="_blank">www.lyblogs.cn</a>
                                </p>
                                <p>
                                    &nbsp; &nbsp; 转载请注明出处！<img src="http://www.lyblogs.cn/kindeditor/plugins/emoticons/images/0.gif" border="0" alt="" />
                                </p>
                                <p>
                                    <br />
                                </p>
                            </div>
                        </div>
                        <!-- 评论区域 -->
                        <div class="blog-module shadow" style="box-shadow: 0 1px 8px #a6a6a6;">
                            <fieldset class="layui-elem-field layui-field-title" style="margin-bottom:0">
                                <legend>来说两句吧</legend>
                                <div class="layui-field-box">
                                    <form class="layui-form blog-editor" action="">
                                        <div class="layui-form-item">
                                            <textarea name="editorContent" lay-verify="content" id="remarkEditor" placeholder="请输入内容" class="layui-textarea layui-hide"></textarea>
                                        </div>
                                        <div class="layui-form-item">
                                            <button class="layui-btn" lay-submit="formRemark" lay-filter="formRemark">提交评论</button>
                                        </div>
                                    </form>
                                </div>
                            </fieldset>
                            <div class="blog-module-title">最新评论</div>
                            <ul class="blog-comment">
                                <li>
                                    <div class="comment-parent">
                                        <img src="../images/Absolutely.jpg" alt="absolutely" />
                                        <div class="info">
                                            <span class="username">Absolutely</span>
                                            <span class="time">2017-03-18 18:46:06</span>
                                        </div>
                                        <div class="content">
                                            我为大家做了模拟评论功能！还有，这个评论功能也可以改成和留言一样，但是目前没改，有兴趣可以自己改
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="blog-main-right">
                        <!--右边悬浮 平板或手机设备显示-->
                        <div class="category-toggle"><i class="fa fa-chevron-left"></i></div><!--这个div位置不能改，否则需要添加一个div来代替它或者修改样式表-->
                        <div class="article-category shadow">
                            <div class="article-category-title">分类导航</div>
                            <!-- 点击分类后的页面和artile.html页面一样，只是数据是某一类别的 -->
                            <a href="javascript:layer.msg(&#39;切换到相应分类&#39;)">ASP.NET MVC</a>
                            <a href="javascript:layer.msg(&#39;切换到相应分类&#39;)">SQL Server</a>
                            <a href="javascript:layer.msg(&#39;切换到相应分类&#39;)">Entity Framework</a>
                            <a href="javascript:layer.msg(&#39;切换到相应分类&#39;)">Web前端</a>
                            <a href="javascript:layer.msg(&#39;切换到相应分类&#39;)">C#基础</a>
                            <a href="javascript:layer.msg(&#39;切换到相应分类&#39;)">杂文随笔</a>
                            <div class="clear"></div>
                        </div>
                        <div class="blog-module shadow">
                            <div class="blog-module-title">相似文章</div>
                            <ul class="fa-ul blog-module-ul">
                                <li><i class="fa-li fa fa-hand-o-right"></i><a href="detail.html">基于laypage的layui扩展模块（pagesize.js）！</a></li>
                                <li><i class="fa-li fa fa-hand-o-right"></i><a href="detail.html">基于laypage的layui扩展模块（pagesize.js）！</a></li>
                                <li><i class="fa-li fa fa-hand-o-right"></i><a href="detail.html">基于laypage的layui扩展模块（pagesize.js）！</a></li>
                            </ul>
                        </div>
                        <div class="blog-module shadow">
                            <div class="blog-module-title">随便看看</div>
                            <ul class="fa-ul blog-module-ul">
                                <li><i class="fa-li fa fa-hand-o-right"></i><a href="detail.html">一步步制作时光轴（一）（HTML篇）</a></li>
                                <li><i class="fa-li fa fa-hand-o-right"></i><a href="detail.html">ASP.NET MVC制作404跳转（非302和200）</a></li>
                                <li><i class="fa-li fa fa-hand-o-right"></i><a href="detail.html">ASP.NET MVC 防范跨站请求伪造（CSRF）</a></li>
                                <li><i class="fa-li fa fa-hand-o-right"></i><a href="detail.html">一步步制作时光轴（三）（JS篇）</a></li>
                                <li><i class="fa-li fa fa-hand-o-right"></i><a href="detail.html">基于laypage的layui扩展模块（pagesize.js）！</a></li>
                                <li><i class="fa-li fa fa-hand-o-right"></i><a href="detail.html">一步步制作时光轴（二）（CSS篇）</a></li>
                                <li><i class="fa-li fa fa-hand-o-right"></i><a href="detail.html">写了个Win10风格快捷菜单！</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script src="{{asset('/templates/home/js/detail.js')}}"></script>

    <script type="text/javascript">

        var resizeHero = function () {
            var hero = $(".cover,.heightblock"),
                    window1 = $(window);
            hero.css({
                "height": window1.height()
            });
        };

        resizeHero();

        $(window).resize(function () {
            resizeHero();
        });

    </script>
    {{--<script src="{{asset('/templates/home/js/home.js}}"></script>--}}
    <script src="{{asset('/templates/home/js/plugins.min.js')}}"></script><!-- Bootstrap core and concatenated plugins always load here -->
    <script src="{{asset('/templates/home/js/jquery.flexslider-min.js')}}"></script><!-- Flexslider plugin -->
    <script src="{{asset('/templates/home/js/scripts.js')}}"></script><!-- Theme scripts -->
    <script src="{{asset('/templates/home/js/jquery.fancybox.pack.js')}}"></script>

    <script type="text/javascript">
        $('#intro').find('img').each(function(){
            var alt = this.alt;

            if (alt){
                $(this).after('<span class="caption" style="display:none">' + alt + '</span>');
            }

            $(this).wrap('<a href="' + this.src + '" title="' + alt + '" class="fancybox" rel="gallery" />');
        });
        (function($){
            $('.fancybox').fancybox();
        })(jQuery);
    </script>
    <!-- Initiate flexslider plugin -->
    <script type="text/javascript">
        $(document).ready(function($) {
            $('.flexslider').flexslider({
                animation: "fade",
                prevText: "",
                nextText: "",
                directionNav: true
            });

        });


    </script>
    <script>


        (function(){
            var bp = document.createElement('script');
            var curProtocol = window.location.protocol.split(':')[0];
            if (curProtocol === 'https') {
                bp.src = 'https://zz.bdstatic.com/linksubmit/push.js';
            }
            else {
                bp.src = 'http://push.zhanzhang.baidu.com/push.js';
            }
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(bp, s);
        })();


    </script>







@endsection