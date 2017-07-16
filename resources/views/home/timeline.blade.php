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
    <section id="services">
        <div class="blog-body" style="margin-top:-30px">
            <div class="blog-container">
                <div class="blog-main">
                    <div class="timeline-box shadow">
                        <div class="timeline-main">
                            <h1><i class="fa fa-clock-o"></i>时光轴<span> —— 记录生活点点滴滴</span></h1>
                            <div class="timeline-line"></div>
                            <div class="timeline-year">
                                <h2><a class="yearToggle" href="javascript:;">2017年</a><i class="fa fa-caret-down fa-fw"></i></h2>
                                <div class="timeline-month">
                                    <h3 class=" animated fadeInLeft"><a class="monthToggle" href="javascript:;">2月</a><i class="fa fa-caret-down fa-fw"></i></h3>
                                    <ul>
                                        <li class=" ">
                                            <div class="h4  animated fadeInLeft">
                                                <p class="date">02月23日 19:33</p>
                                            </div>
                                            <p class="dot-circle animated "><i class="fa fa-dot-circle-o"></i></p>
                                            <div class="content animated fadeInRight">该时光轴支持手机平板PC，但并不能兼容一些老的浏览器！</div>
                                            <div class="clear"></div>
                                        </li>
                                        <li class=" ">
                                            <div class="h4  animated fadeInLeft">
                                                <p class="date">02月11日 20:29</p>
                                            </div>
                                            <p class="dot-circle animated "><i class="fa fa-dot-circle-o"></i></p>
                                            <div class="content animated fadeInRight">这是2017年2月发表的</div>
                                            <div class="clear"></div>
                                        </li>
                                        <li class=" ">
                                            <div class="h4  animated fadeInLeft">
                                                <p class="date">02月10日 20:35</p>
                                            </div>
                                            <p class="dot-circle animated "><i class="fa fa-dot-circle-o"></i></p>
                                            <div class="content animated fadeInRight">这是2017年2月发表的</div>
                                            <div class="clear"></div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="timeline-month">
                                    <h3 class=" animated fadeInLeft"><a class="monthToggle" href="javascript:;">1月</a><i class="fa fa-caret-down fa-fw"></i></h3>
                                    <ul>
                                        <li class=" ">
                                            <div class="h4  animated fadeInLeft">
                                                <p class="date">01月23日 19:33</p>
                                            </div>
                                            <p class="dot-circle animated "><i class="fa fa-dot-circle-o"></i></p>
                                            <div class="content animated fadeInRight">这是2017年1月发表的</div>
                                            <div class="clear"></div>
                                        </li>
                                        <li class=" ">
                                            <div class="h4  animated fadeInLeft">
                                                <p class="date">01月11日 20:29</p>
                                            </div>
                                            <p class="dot-circle animated "><i class="fa fa-dot-circle-o"></i></p>
                                            <div class="content animated fadeInRight">这是2017年1月发表的</div>
                                            <div class="clear"></div>
                                        </li>
                                        <li class=" ">
                                            <div class="h4  animated fadeInLeft">
                                                <p class="date">01月10日 20:35</p>
                                            </div>
                                            <p class="dot-circle animated "><i class="fa fa-dot-circle-o"></i></p>
                                            <div class="content animated fadeInRight">这是2017年1月发表的</div>
                                            <div class="clear"></div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="timeline-year">
                                <h2><a class="yearToggle" href="javascript:;">2016年</a><i class="fa fa-caret-down fa-fw"></i></h2>
                                <div class="timeline-month">
                                    <h3 class=" animated fadeInLeft"><a class="monthToggle" href="javascript:;">2月</a><i class="fa fa-caret-down fa-fw"></i></h3>
                                    <ul>
                                        <li class=" ">
                                            <div class="h4  animated fadeInLeft">
                                                <p class="date">02月23日 19:33</p>
                                            </div>
                                            <p class="dot-circle animated "><i class="fa fa-dot-circle-o"></i></p>
                                            <div class="content animated fadeInRight">这是2016年2月发表的</div>
                                            <div class="clear"></div>
                                        </li>
                                        <li class=" ">
                                            <div class="h4  animated fadeInLeft">
                                                <p class="date">02月11日 20:29</p>
                                            </div>
                                            <p class="dot-circle animated "><i class="fa fa-dot-circle-o"></i></p>
                                            <div class="content animated fadeInRight">这是2016年2月发表的</div>
                                            <div class="clear"></div>
                                        </li>
                                        <li class=" ">
                                            <div class="h4  animated fadeInLeft">
                                                <p class="date">02月10日 20:35</p>
                                            </div>
                                            <p class="dot-circle animated "><i class="fa fa-dot-circle-o"></i></p>
                                            <div class="content animated fadeInRight">这是2016年2月发表的</div>
                                            <div class="clear"></div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="timeline-month">
                                    <h3 class=" animated fadeInLeft"><a class="monthToggle" href="javascript:;">1月</a><i class="fa fa-caret-down fa-fw"></i></h3>
                                    <ul>
                                        <li class=" ">
                                            <div class="h4  animated fadeInLeft">
                                                <p class="date">01月23日 19:33</p>
                                            </div>
                                            <p class="dot-circle animated "><i class="fa fa-dot-circle-o"></i></p>
                                            <div class="content animated fadeInRight">这是2016年1月发表的</div>
                                            <div class="clear"></div>
                                        </li>
                                        <li class=" ">
                                            <div class="h4  animated fadeInLeft">
                                                <p class="date">01月11日 20:29</p>
                                            </div>
                                            <p class="dot-circle animated "><i class="fa fa-dot-circle-o"></i></p>
                                            <div class="content animated fadeInRight">这是2016年1月发表的</div>
                                            <div class="clear"></div>
                                        </li>
                                        <li class=" ">
                                            <div class="h4  animated fadeInLeft">
                                                <p class="date">01月10日 20:35</p>
                                            </div>
                                            <p class="dot-circle animated "><i class="fa fa-dot-circle-o"></i></p>
                                            <div class="content animated fadeInRight">这是2016年1月发表的</div>
                                            <div class="clear"></div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <h1 style="padding-top:4px;padding-bottom:2px;margin-top:40px;"><i class="fa fa-hourglass-end"></i>THE END</h1>
                        </div>
                    </div>
                </div>
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