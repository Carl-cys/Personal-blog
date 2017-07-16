<!DOCTYPE html>
<!-- saved from url=(0022)https://www.iphpt.com/ -->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-CN" lang="zh-CN" class="js flexbox flexboxlegacy canvas canvastext no-touch indexeddb hashchange history draganddrop rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients cssreflections csstransforms csstransforms3d csstransitions fontface generatedcontent video audio localstorage applicationcache sb-init" style="overflow-y: hidden;"><!--<![endif]--><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Mogo</title>
    <!-- Meta data -->
    <meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="Mogo大叔的PHP个人技术博客，分享一些技术文章，分享一些琐碎">
    <meta name="keywords" content="Mogo大叔、个人博客、技术博客、Linux、php、ubuntu、laravel博客、laravel、php学习、iphpt、iphp、phpt、it里做php的">

    @yield('style')
    <link rel="Shortcut Icon" href="{{ asset('/templates/home/img/nice.png') }}" type="image/ico">
    <link href="{{asset('/templates/home/plug/layui/layui.js')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('/templates/home/css/all.css') }}" media="screen" type="text/css">

    <link rel="stylesheet" href="{{ asset('/templates/home/css/xcode.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/templates/home/css/jquery.fancybox.css') }}" media="screen" type="text/css">

    <script src="{{ asset('/templates/home/js/push.js') }}"></script>
    <script src="{{ asset('/templates/home/js/jquery.min.js') }}"></script>
    <link href="{{ asset('/templates/home/plug/layui/css/layui.css')}}" rel="stylesheet" />
    <!--font-awesome-->
    <link href="{{asset('/templates/home/plug/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" />
    <!--全局样式表-->
    <link href="{{asset('/templates/home/css/global.css')}}" rel="stylesheet" />
    <!-- 本页样式表 -->
    <style>.col-md-8.col-md-offset-2.opening-statement img{display:none;}</style>
    <style type="text/css">.fancybox-margin{margin-right:0px;}</style>

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
    <!-- Lists in Slidebars -->
    <ul class="sb-menu">
        <li><a href="{{ url('/index') }}" class="animsition-link" title="Home">Home</a></li>
        <!-- Dropdown Menu -->
        <li>
            <a class="sb-toggle-submenu">tags<span class="sb-caret"></span></a>
            <ul class="sb-submenu">
                {{--@foreach($tags as $tag)--}}
                {{--<li>--}}
                {{--<a href="https://www.iphpt.com/tags/%E5%85%B3%E4%BA%8E" target="_BLANK" class="animsition-link">--}}
                {{--{{$tag->tag_name}}--}}
                {{--<small>{{$tag->tag_number}}</small>--}}
                {{--</a>--}}
                {{--</li>--}}
                {{--@endforeach--}}
            </ul>
        </li>

        <li>
            <a class="sb-toggle-submenu">Categories<span class="sb-caret"></span></a>
            <ul class="sb-submenu">
                {{--@foreach($category as $v)--}}
                {{--<li><a href="/categories/{{$v->cate_name}}" class="animsition-link">{{$v->cate_name}}</a></li>--}}
                {{--@endforeach--}}
            </ul>
        </li>


        <li>
            <a class="sb-toggle-submenu">Links<span class="sb-caret"></span></a>
            <ul class="sb-submenu">
                <li><a href="http://ylsc633.com/" target="_blank" class="link">叶落山城</a></li>
                <li><a href="http://go.kieran.top/" target="_blank" class="link"> kieran</a></li>
                <li><a href="http://www.liveinline.com/" target="_blank" class="link">小强在线</a></li>
                <li><a href="https://phphub.org/" target="_blank" class="link">phphub社区</a></li>
                <li><a href="http://iterabc.com/" target="_blank" class="link">程序人生</a></li>
                <li><a href="http://weber.pub/" target="_blank" class="link">Web开发者</a></li>
                <li><a href="http://blog.xcatliu.com/" target="_blank" class="link">Xcat Liu's Blog</a></li>
                <li><a href="http://www.w3cvip.com/" target="_blank" class="link">前端网-web前端技术分享平台</a></li>

            </ul>
        </li>

    </ul>
    <!-- Lists in Slidebars -->
    <ul class="sb-menu secondary">
        <li><a href="https://www.iphpt.com/monthList" class="animsition-link" title="归档">归档</a></li>

        <li><a href="https://www.iphpt.com/about" class="animsition-link" title="about">About</a></li>
    </ul>
</div>


<div id="sb-site" style="min-height: 619px;">
    <!-- #sb-site - All page content should be contained within this id, except the off-canvas navigation itself -->

    <!-- ============================ Nav Header & Logo bar =========================== -->

    <div id="navigation" class="navbar navbar-fixed-top" style="top: 0px;">
        <div class="navbar-inner">
            <div class="container">
                <!-- Nav logo -->
                <div class="logo">
                    <a href="./叶落山城秋_files/叶落山城秋.html" title="iphpt" class="animsition-link">
                        <img src="./叶落山城秋_files/nice.png" alt="logo" width="35px;">
                    </a>
                </div>
                <!-- // Nav logo -->
                <!-- Nav -->

                <nav>
                    <ul class="nav">
                        <li><a href="./叶落山城秋_files/叶落山城秋.html" class="animsition-link">叶落山城秋</a></li>

                        <li><a href="https://github.com/Yela528/laravel-5-myblog" title="Github" target="_blank"><i class="icon-github"></i></a></li>






                        <li><a href="http://weibo.com/ylsc633?refer_flag=1001030101_&is_hot=1" title="Sina-Weibo" target="_blank"><i class="icon-sina-weibo"></i></a></li>

                        <li class="nolink"><span><a href="http://www.iphpt.com/detail/1/">给我留言</a></span></li>
                        <li class="nolink"><span>Welcome!</span></li>

                    </ul>
                </nav>



            </div>
            <!-- // .container -->
            <div class="learnmore sb-toggle-right">More</div>
            <button type="button" class="navbar-toggle menu-icon sb-toggle-right" title="More">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar before"></span>
                <span class="icon-bar main"></span>
                <span class="icon-bar after"></span>
            </button>
        </div>
        <!-- // .navbar-inner -->
    </div>


    <!-- ============================ 图片 =========================== -->
    @yield('hero')

            <!-- ============================ 内容 =========================== -->

    @yield('content')




    @section('statement')

    @show

            <!-- ============================ END Content =========================== -->
</div>

<!-- ============================ Footer =========================== -->

@section('footer')
    <footer>
        <div class="container">
            <div>
                <p>欢迎加入交流群(群号):440221268</p>
            </div>
            <div>
                <p>我的阿里云9折购买推荐码为:y2jcyp</p><i class="icon-facebook"></i>
            </div>
        </div>
        <div class="container">
            <div class="copy">
                <p>
                    © 2014<script>new Date().getFullYear()>2010&&document.write("-"+new Date().getFullYear());</script>-2017, Content By 叶落山城. All Rights Reserved.
                </p>

            </div>
            <div class="social">
                <ul>

                    <li><a href="https://github.com/Yela528/laravel-5-myblog" title="Github" target="_blank"><i class="icon-github"></i></a>&nbsp;</li>


                    <li><a href="https://www.iphpt.com/#" title="阿里云推荐码" target="_blank"><i class="icon-qq"></i></a>&nbsp;</li>




                    <li><a href="http://weibo.com/ylsc633?refer_flag=1001030101_&is_hot=1" title="Sina-Weibo" target="_blank"><i class="icon-sina-weibo"></i></a>&nbsp;</li>

                </ul>
                <script src="./叶落山城秋_files/z_stat.php" language="JavaScript"></script><script src="./叶落山城秋_files/core.php" charset="utf-8" type="text/javascript"></script><a href="http://www.cnzz.com/stat/website.php?web_id=1256842383" target="_blank" title="站长统计">站长统计</a>

            </div>

            <div class="clearfix"> </div>
        </div>
    </footer>
@show




@section('js')



@show

</html>
