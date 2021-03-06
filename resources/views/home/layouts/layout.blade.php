<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-CN" lang="zh-CN" class="js flexbox flexboxlegacy canvas canvastext no-touch indexeddb hashchange history draganddrop rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients cssreflections csstransforms csstransforms3d csstransitions fontface generatedcontent video audio localstorage applicationcache sb-init" style="overflow-y: hidden;"><!--<![endif]--><head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>@yield('title'){{ config('config.inc.title') }}</title>
    <!-- Meta data -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('desc', config('config.inc.desc'))">
    <meta name="keywords" content="@yield('keyword', config('config.inc.keyword'))">
    <link rel="Shortcut Icon" href="{{ asset('/templates/home/img/favicon.ico') }}" type="image/ico">
    <!--全局样式表-->
    <link href="{{asset('/templates/home/css/global.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('/templates/home/css/all.css') }}" media="screen" type="text/css">
    {{--    <link rel="stylesheet" href="{{ asset('/templates/home/css/xcode.css') }}" type="text/css">--}}
    <link rel="stylesheet" href="{{ asset('/templates/home/css/jquery.fancybox.css') }}" media="screen" type="text/css">
    <script src="{{ asset('/templates/home/js/push.js') }}"></script>
    <script src="{{asset('templates/admin/plugin/jq/jquery-1.10.2.min.js')}}"></script>
    <script src="{{asset('templates/admin/plugin/layui/layui.js')}}"></script>
    <!--font-awesome-->
    <link href="{{asset('/templates/home/plug/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" />
    <!-- 本页样式表 -->
    <style>.col-md-8.col-md-offset-2.opening-statement img{display:none;}</style>
    <style type="text/css">.fancybox-margin{margin-right:0px;}</style>
    <link href="{{ asset('/templates/home/plug/layui/css/layui.css')}}" rel="stylesheet" />
    @yield('style')
</head>
<body id="index" class="lightnav animsition pace-done" style="animation-duration: 0.9s; opacity: 1;"><div class="pace  pace-inactive"><div class="pace-progress" data-progress-text="100%" data-progress="99" style="transform: translate3d(100%, 0px, 0px);">
        <div class="pace-progress-inner"></div>
    </div>
    <div class="pace-activity"></div></div>
<!-- ============================ 左边的导航=========================== -->

<div class="sb-slidebar sb-right sb-style-overlay sb-momentum-scrolling" style="margin-right: -273.188px;">
    <div class="sb-close" aria-label="Close Menu" aria-hidden="true">
        <img src="{{ asset('/templates/home/default/img/close.png') }}" alt="Close">
    </div>
    {{--{{dd()}}--}}
    <ul class="sb-menu">
        @forelse( $navigation as $nav )
            <li><a href="{{ $nav->url }}" class="animsition-link" title="Home">{{$nav->title}}</a></li>
        @empty
        @endforelse
        <li>
            <a class="sb-toggle-submenu">友情<span class="sb-caret"></span></a>
            <ul class="sb-submenu">
                @forelse($links as $link)
                    <li><a href="{{$link->link}}" target="_blank" class="link">{{$link->name}}</a></li>
                @empty
                @endforelse
            </ul>
        </li>

    </ul>
    <!-- Lists in Slidebars -->
    <ul class="sb-menu secondary">
       <!-- <li><a href="#" class="animsition-link" title="归档">归档</a></li>-->
 
        <li><a href="{{url('/home/about')}}" class="animsition-link" title="about">About</a></li>
    </ul>
</div>
{{--中间导航--}}
<div id="sb-site" style="min-height: 619px;">
    <!-- ============================ Nav Header & Logo bar =========================== -->
    <div id="navigation" class="navbar navbar-fixed-top" style="top: 0px;">
        <div class="navbar-inner">
            <div class="container">
                <!-- Nav logo -->
                <div class="logo">
                    <a href="{{url('/home')}}" title="{{ config('config.inc.title') }}" class="animsition-link">
                        <img src="{{ url(config('config.inc.logo')) }}" alt="logo" width="45px;" style="border-radius: 50%;">
                    </a>
                </div>
                <nav>
                    <ul class="nav">
                        <li><a href="{{url('/home')}}" class="animsition-link">{{ config('config.inc.title') }}</a></li>

                        <li><a href="{{ config('config.inc.github') }}" title="Github" target="_blank"><i class="icon-github"></i></a></li>

                        <li><a href="{{ config('config.inc.sina-weibo') }}" title="Sina-Weibo" target="_blank"><i class="icon-sina-weibo"></i></a></li>
                        <li class="nolink"><span>Welcome!</span></li>
                    </ul>
                </nav>
            </div>
            <div class="learnmore sb-toggle-right">More</div>
            <button type="button" class="navbar-toggle menu-icon sb-toggle-right" title="More">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar before"></span>
                <span class="icon-bar main"></span>
                <span class="icon-bar after"></span>
            </button>
        </div>
    </div>


    <!-- ============================ 图片 =========================== -->
    @section('hero')

    @show
            <!-- ============================ 内容 =========================== -->
    @yield('content')
    <section id="statement">
        <div class="container text-center wow fadeInUp" data-wow-delay="0.5s" style="visibility: hidden; animation-delay: 0.5s; animation-name: none;">
            <div class="row">
                <p>{{ config('config.inc.text') }}</p>
            </div>
        </div>
    </section>
</div>
@section('footer')
    <footer>
        <div class="container">
        </div>
        <div class="container">
            <div class="copy">
                <p>
                    ©2017<script>new Date().getFullYear()>2010&&document.write("-"+new Date().getFullYear());</script>{{ config('config.inc.copyright') }}-{{ config('config.inc.number') }}
                </p>

            </div>
            <!-- <h3 style="text-align: center;color:#fff;">{{ config('config.inc.cooperation') }}</h3>-->
            <div class="social">
            <ul>

            <li><a href="{{ config('config.inc.github') }}" title="Github" target="_blank"><i class="icon-github"></i></a>&nbsp;</li>

            <li><a href="{{ config('config.inc.sina-weibo') }}" title="Sina-Weibo" target="_blank"><i class="icon-sina-weibo"></i></a>&nbsp;</li>

            </ul>
            </div>

            <div class="clearfix"> </div>
        </div>
    </footer>
    <!--分享窗体-->
    <div class="blog-share layui-hide">
        <div class="blog-share-body">
            <div style="width: 200px;height:100%;">
                <div class="bdsharebuttonbox">
                    <a class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a>
                    <a class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a>
                    <a class="bds_weixin" data-cmd="weixin" title="分享到微信"></a>
                    <a class="bds_sqq" data-cmd="sqq" title="分享到QQ好友"></a>
                </div>
            </div>
        </div>
    </div>
    <div class="blog-mask animated layui-hide"></div>
@show

@yield('js')
<script src="{{asset('/templates/home/js/global.js')}}"></script><!-- Bootstrap core and concatenated plugins always load here -->
<script src="{{asset('/templates/home/js/plugins.min.js')}}"></script><!-- Bootstrap core and concatenated plugins always load here -->
<script src="{{asset('/templates/home/js/jquery.flexslider-min.js')}}"></script><!-- Flexslider plugin -->
<script src="{{asset('/templates/home/js/scripts.js')}}"></script><!-- Theme scripts -->
<script src="{{asset('/templates/home/js/jquery.fancybox.pack.js')}}"></script>
<script type="text/javascript">
    var resizeHero = function() {
        var hero = $(".cover,.heightblock"),
                window1 = $(window);
        hero.css({
            "height": window1.height()
        });
    };

    resizeHero();

    $(window).resize(function() {
        resizeHero();
    });
    $('#intro').find('img').each(function() {
        var alt = this.alt;

        if (alt) {
            $(this).after('<span class="caption" style="display:none">' + alt + '</span>');
        }

        $(this).wrap('<a href="' + this.src + '" title="' + alt + '" class="fancybox" rel="gallery" />');
    });
    (function($) {
        $('.fancybox').fancybox();
    })(jQuery);
    $(document).ready(function($) {
        $('.flexslider').flexslider({
            animation: "fade",
            prevText: "",
            nextText: "",
            directionNav: true
        });

    });

    (function() {
        var bp = document.createElement('script');
        var curProtocol = window.location.protocol.split(':')[0];
        if (curProtocol === 'https') {
            bp.src = 'https://zz.bdstatic.com/linksubmit/push.js';
        } else {
            bp.src = 'http://push.zhanzhang.baidu.com/push.js';
        }
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(bp, s);
    })();
	

    //百度分享插件
    window._bd_share_config = {
        "common": {
            "bdSnsKey": {},
            "bdText": "",
            "bdStyle": "0",
            "bdSize": "32"
        },
        "share": {}
    };
    with (document) 0[(getElementsByTagName('head')[0] || body).appendChild(createElement('script')).src = '{{ url('static/api/js/share.js?v=89860593.js?cdnversion=') }}' + ~(-new Date() / 36e5)];
    

</script>

</html>
