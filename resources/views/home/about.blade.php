@extends('Home.layouts.layout')
@section('style')
    <link href="{{asset('/templates/home/css/timeline.css')}}" rel="stylesheet" />

@endsection

@section('hero')
    <section id="hero" class="scrollme">
        <div class="container-fluid element-img" style="background: url(https://odu38kv7q.qnssl.com/category.jpg) no-repeat center center fixed;background-size: cover">
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
        <div class="container">
            <div class="row col-md-offset-2">
                <div class="col-md-8">
    			<span class="post-meta">
      <time datetime="2016-08-13 09:31:22" itemprop="datePublished">
          2016-08-13 09:31:22
      </time>


</span>
                    <h1>关于</h1>
                </div>
            </div>
            <div class="col-md-8 col-md-offset-2">
                <h2>关于</h2><p>&nbsp;&nbsp;念大学时候就想做个自己的博客，去年开始入行，利用emlog和zblog两个博客模板，然后自己找了两个页面，进行嵌套，逻辑和后台完全不是自己写的，想想，还是想自己写个博客网站，所有逻辑都自己写！<br>&nbsp;&nbsp;之前半年比较忙，一直没时间动手，现在稍微闲散了下来，正好工作上要用到laravel框架，虽然已经用在项目上了，但是都是对着文档边看别写，很多深的东西都不知道怎么用，也不知道去用，正好乘着这次，利用laravel5.1框架，自己写了个博客，想试试一些知识，比如orm多对多，比如代码规范，等等很多东西！</p><ul><li><p>后台<br>&nbsp;&nbsp;&nbsp;&nbsp;这次后台，是从模板之家找到的一个模板，个人感觉还是挺好的，虽然还是有很多页面的问题，比如左侧列表点击后，页面刷新，ul列表就收起来了，还有后台可以换背景图，但是有些还是有问题，而且背景图不能保存设置，刷新就又换回去了，这些都是问题，还得慢慢解决！</p></li><li><p>前台<br>&nbsp;&nbsp;&nbsp;&nbsp;前台，我利用关键词HTML5、响应式模板 等等百度搜索，看了几十个网站，没找到一个我喜欢的模板，后来又找了wordpress等等一些主题，还是不好，最后从知乎上看到hexo的主题，找到了现在的这个，一看就很喜欢了，(也可能是首页的喵星人)，主题简洁好看，正和我意，然后利用链接找到github的这个<a href="https://github.com/SuperKieran/TKL">主题地址</a>，down下来以后，懵逼了，是nodeJs的ejs模板引擎，虽然语法很简单，但是很多文件，不知道要用哪些，也不知道引入哪些！不过突然我想到了一个方法，利用wget命令，把博主站拿下来，不就是静态的页面了嘛，那我不就会套了嘛，哈哈哈哈！机智如我啊！</p></li></ul><p>。。。。未完待续</p>


                <div class="clearfix"></div>
                <hr class="nogutter">
            </div>
            <nav class="pagination" role="pagination">


            </nav>


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