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
                        <i style="float:left;line-height:20px;" class="fa fa-volume-up"></i>
                        <div class="home-tips-container" style="height: 23px">
{{--                            @if(empty)--}}
                            @forelse($notice as $not)
                            <span style="color: {{$not->color}}">{!! $not->content!!}</span>
                                @empty
                                <p>无</p>
                            {{--<span style="color: #009688">偷偷告诉大家，本博客的后台管理也12312312正在制作，为大家准备了游客专用账号！</span>--}}
                            @endforelse
                            {{--<span style="color: red">网站新增留言回复啦！使用QQ登陆即可回复，人人都可以回复！</span>--}}
                            {{--<span style="color: red">如果你觉得网站做得还不错，来Fly社区点个赞吧！<a href="http://fly.layui.com/case/2017/" target="_blank" style="color:#01AAED">点我前往</a></span>--}}
                            {{--<span style="color: #009688">不落阁 &nbsp;—— &nbsp;一个.NET程序员的个人博客，新版网站采用Layui为前端框架，目前正在建设中！</span>--}}
                        </div>
                    </div>
                    <!--左边文章列表-->
                    <div class="blog-main-left">
                        @foreach($articlelist as $list)
                        <div class="article shadow">
                            <div class="article-left">
                                <img width='200' height="130" src="{{$list->img}}" alt="{{$list->title}}" />
                            </div>
                            <div class="article-right">
                                <div class="article-title">
                                    <a href="{{url('/home/detail/'.$list->id)}}">{{$list->title}}</a>
                                </div>
                                <div class="article-abstract">
                                    {{$list->abstract}}
                                </div>
                            </div>
                            <div class="clear"></div>
                            <div class="article-footer">
                                <span><i class="fa fa-clock-o"></i>&nbsp;&nbsp;{{$list->created_at}}</span>
                                <span class="article-author"><i class="fa fa-user"></i>&nbsp;&nbsp;{{$list->author}}</span>
                                <span><i class="fa fa-tag"></i>&nbsp;&nbsp;<a href="#">{{$list->cate_id}}</a></span>
                                <span class="article-viewinfo"><i class="fa fa-eye"></i>&nbsp;浏览数</span>
                                <span class="article-viewinfo"><i class="fa fa-commenting"></i>&nbsp;</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!--右边小栏目-->
                    <div class="blog-main-right">
                        <div class="blogerinfo shadow">
                            <div class="blogerinfo-figure">
                                <img src="{{$info->img}}" alt="Absolutely" style="width: 200px"/>
                            </div>
                            <p class="blogerinfo-nickname">{{$info->name}}</p>
                            <p class="blogerinfo-introduce">{{$info->profile}}</p>
                            <p class="blogerinfo-location"><i class="fa fa-location-arrow"></i>&nbsp;{{$info->address}}</p>
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
                                @foreach($articleclicks as $clicks)
                                <li><i class="fa-li fa fa-hand-o-right"></i> <a href="{{url('/home/detail/'.$clicks->id)}}">{{$clicks->title}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="blog-module shadow">
                            <div class="blog-module-title">最近分享</div>
                            <ul class="fa-ul blog-module-ul">
                                @foreach($resource as $res)
                                <li><i class="fa-li fa fa-hand-o-right"></i><a href="{{$res->download_url}}" target="_blank">{{$res->title}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="blog-module shadow">
                            <div class="blog-module-title">一路走来</div>
                            <dl class="footprint">
                                @foreach($timeline as $time)
                                <dt>{{$time->created_at}}</dt>
                                <dd>{{$time->title}}</dd>
                                @endforeach
                            </dl>
                        </div>
                        <div class="blog-module shadow">
                            <div class="blog-module-title">友情链接</div>
                            <ul class="blogroll">
                                @foreach($links as $link)
                                <li><a target="_blank" href="/{{$link->link}}" title="{{$link->name}}">{{$link->name}}</a></li>
                                @endforeach
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
{{--    <script src="{{ asset('/templates/home/js/home.js') }}"></script>--}}
    <script>
        $(function () {
            //播放公告
            playAnnouncement(3000);
        });
        function playAnnouncement(interval) {
            var index = 0;
            var $announcement = $('.home-tips-container>span');
            //自动轮换
            setInterval(function () {
                index++;    //下标更新
                if (index >= $announcement.length) {
                    index = 0;
                }
                $announcement.eq(index).stop(true, true).fadeIn().siblings('span').fadeOut();  //下标对应的图片显示，同辈元素隐藏
            }, interval);
        }
    </script>
@endsection
