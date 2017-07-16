@extends('Home.layouts.layout')

@section('style')
    <link href="{{asset('/templates/home/css/home.css')}}" rel="stylesheet" />
@endsection

@section('hero')
    <section id="hero" class="scrollme">
        <div class="container-fluid element-img" style="background: url(https://odu38kv7q.qnssl.com/index.jpg) no-repeat center center fixed;background-size: cover">
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2 vertical-align cover boost text-center" style="height: 619px;">
                    <div class="center-me animateme" data-when="exit" data-from="0" data-to="0.6" data-opacity="0" data-translatey="100">
                        <div>

                            <h2>
                                <a href="https://www.iphpt.com/#intro" class="more scrolly">
                                    命定的局限尽可永在，不屈的挑战却不可须臾或缺！
                                </a>
                            </h2>
                            <p></p>
                            <h2></h2>
                            <p></p>
                        </div>
                    </div>
                </div>
                <!-- // .col-md-12 -->
            </div>
            <div class="herofade beige-dk" style="opacity: 0;"></div>
        </div>
    </section>
    <!-- Height spacing helper -->
    <div class="heightblock" style="height: 619px;"></div>
    <!-- // End height spacing helper -->
@endsection

@section('content')
    <section id="intro">
        <div class="blog-body">
            <!-- 这个一般才是真正的主体内容 -->
            <div class="blog-container">
                <div class="blog-main">
                    <!-- 网站公告提示 -->
                    <div class="home-tips shadow">
                        <i style="float:left;line-height:17px;" class="fa fa-volume-up"></i>
                        <div class="home-tips-container">
                            <span style="color: #009688">偷偷告诉大家，本博客的后台管理也正在制作，为大家准备了游客专用账号！</span>
                            <span style="color: red">网站新增留言回复啦！使用QQ登陆即可回复，人人都可以回复！</span>
                            <span style="color: red">如果你觉得网站做得还不错，来Fly社区点个赞吧！<a href="http://fly.layui.com/case/2017/" target="_blank" style="color:#01AAED">点我前往</a></span>
                            <span style="color: #009688">不落阁 &nbsp;—— &nbsp;一个.NET程序员的个人博客，新版网站采用Layui为前端框架，目前正在建设中！</span>
                        </div>
                    </div>
                    <!--左边文章列表-->
                    <div class="blog-main-left">
                        <div class="article shadow">
                            <div class="article-left">
                                <img width='200' src="{{asset('/templates/home/img/cover/201703181909057125.jpg')}}" alt="基于laypage的layui扩展模块（pagesize.js）！" />
                            </div>
                            <div class="article-right">
                                <div class="article-title">
                                    <a href="detail.html">基于laypage的layui扩展模块（pagesize.js）！</a>
                                </div>
                                <div class="article-abstract">
                                    该模块主要是针对当前版本laypage没有页容量控制功能而制作，使用该模块后即可实现每页显示多少条数据的控制！本人原创，但是可能有可能只对本人的分页写法有用！
                                </div>
                            </div>
                            <div class="clear"></div>
                            <div class="article-footer">
                                <span><i class="fa fa-clock-o"></i>&nbsp;&nbsp;2017-03-18</span>
                                <span class="article-author"><i class="fa fa-user"></i>&nbsp;&nbsp;Absolutely</span>
                                <span><i class="fa fa-tag"></i>&nbsp;&nbsp;<a href="#">Web前端</a></span>
                                <span class="article-viewinfo"><i class="fa fa-eye"></i>&nbsp;0</span>
                                <span class="article-viewinfo"><i class="fa fa-commenting"></i>&nbsp;4</span>
                            </div>
                        </div>
                    </div>
                    <!--右边小栏目-->
                    <div class="blog-main-right">
                        <div class="blogerinfo shadow">
                            <div class="blogerinfo-figure">
                                <img src="{{asset('/templates/home/img/Absolutely.jpg')}}" alt="Absolutely" />
                            </div>
                            <p class="blogerinfo-nickname">Absolutely</p>
                            <p class="blogerinfo-introduce">一枚90后程序员，.NET开发工程师</p>
                            <p class="blogerinfo-location"><i class="fa fa-location-arrow"></i>&nbsp;四川 - 成都</p>
                            <hr />
                            <div class="blogerinfo-contact">
                                <a target="_blank" title="QQ交流" href="javascript:layer.msg('启动QQ会话窗口')"><i class="fa fa-qq fa-2x"></i></a>
                                <a target="_blank" title="给我写信" href="javascript:layer.msg('启动邮我窗口')"><i class="fa fa-envelope fa-2x"></i></a>
                                <a target="_blank" title="新浪微博" href="javascript:layer.msg('转到你的微博主页')"><i class="fa fa-weibo fa-2x"></i></a>
                                <a target="_blank" title="码云" href="javascript:layer.msg('转到你的github主页')"><i class="fa fa-git fa-2x"></i></a>
                            </div>
                        </div>
                        <div></div><!--占位-->
                        <div class="blog-module shadow">
                            <div class="blog-module-title">热文排行</div>
                            <ul class="fa-ul blog-module-ul">
                                <li><i class="fa-li fa fa-hand-o-right"></i><a href="detail.html">Web安全之跨站请求伪造CSRF</a></li>
                                <li><i class="fa-li fa fa-hand-o-right"></i><a href="detail.html">ASP.NET MVC 防范跨站请求伪造（CSRF）</a></li>
                                <li><i class="fa-li fa fa-hand-o-right"></i><a href="detail.html">常用正则表达式</a></li>
                                <li><i class="fa-li fa fa-hand-o-right"></i><a href="detail.html">EF CodeFirst数据迁移常用指令</a></li>
                                <li><i class="fa-li fa fa-hand-o-right"></i><a href="detail.html">浅谈.NET Framework基元类型</a></li>
                                <li><i class="fa-li fa fa-hand-o-right"></i><a href="detail.html">C#基础知识回顾-扩展方法</a></li>
                                <li><i class="fa-li fa fa-hand-o-right"></i><a href="detail.html">一步步制作时光轴（一）（HTML篇）</a></li>
                                <li><i class="fa-li fa fa-hand-o-right"></i><a href="detail.html">一步步制作时光轴（二）（CSS篇）</a></li>
                            </ul>
                        </div>
                        <div class="blog-module shadow">
                            <div class="blog-module-title">最近分享</div>
                            <ul class="fa-ul blog-module-ul">
                                <li><i class="fa-li fa fa-hand-o-right"></i><a href="http://pan.baidu.com/s/1c1BJ6Qc" target="_blank">Canvas</a></li>
                                <li><i class="fa-li fa fa-hand-o-right"></i><a href="http://pan.baidu.com/s/1kVK8UhT" target="_blank">pagesize.js</a></li>
                                <li><i class="fa-li fa fa-hand-o-right"></i><a href="https://pan.baidu.com/s/1mit2aiW" target="_blank">时光轴</a></li>
                                <li><i class="fa-li fa fa-hand-o-right"></i><a href="https://pan.baidu.com/s/1nuAKF81" target="_blank">图片轮播</a></li>
                            </ul>
                        </div>
                        <div class="blog-module shadow">
                            <div class="blog-module-title">一路走来</div>
                            <dl class="footprint">
                                <dt>2017年03月12日</dt>
                                <dd>新增留言回复功能！人人都可参与回复！</dd>
                                <dt>2017年03月10日</dt>
                                <dd>不落阁2.0基本功能完成，正式上线！</dd>
                                <dt>2017年03月09日</dt>
                                <dd>新增文章搜索功能！</dd>
                                <dt>2017年02月25日</dt>
                                <dd>QQ互联接入网站，可QQ登陆发表评论与留言！</dd>
                            </dl>
                        </div>
                        <div class="blog-module shadow">
                            <div class="blog-module-title">后台记录</div>
                            <dl class="footprint">
                                <dt>2017年03月16日</dt>
                                <dd>分页新增页容量控制</dd>
                                <dt>2017年03月12日</dt>
                                <dd>新增管家提醒功能</dd>
                                <dt>2017年03月10日</dt>
                                <dd>新增Win10快捷菜单</dd>
                            </dl>
                        </div>
                        <div class="blog-module shadow">
                            <div class="blog-module-title">友情链接</div>
                            <ul class="blogroll">
                                <li><a target="_blank" href="http://www.layui.com/" title="Layui">Layui</a></li>
                                <li><a target="_blank" href="http://www.pagemark.cn/" title="页签">页签</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        </div>

    </section>

@endsection

@section('statement')
    <section id="statement">
        <div class="container text-center wow fadeInUp" data-wow-delay="0.5s" style="visibility: hidden; animation-delay: 0.5s; animation-name: none;">
            <div class="row">
                <p>当你能力不能满足你的野心的时候,你就该沉下心来学习</p>
            </div>
        </div>
    </section>
@endsection

@section('js')

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
