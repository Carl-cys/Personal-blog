@extends('Home.layouts.layout')

@section('style')
    <link href="{{asset('/templates/home/css/resource.css')}}" rel="stylesheet" />

@endsection
@section('hero')
    <section id="hero" class="scrollme">
        <div class="container-fluid element-img" style="background: url(https://odu38kv7q.qnssl.com/tags.jpg) no-repeat center center fixed;background-size: cover">
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
        <div class="blog-body" style="margin-top: -140px;">
            <div class="blog-container" style="margin-top: 130px;">
                <blockquote class="sitemap layui-elem-quote layui-breadcrumb shadow" style="visibility: visible;">
                    <a href="/" title="网站首页">网站首页<span class="layui-box">&gt;</span></a>
                    <a><cite>资源分享</cite></a>
                </blockquote>
                <div class="blog-main">
                    <div class="blog-main">
                        <div class="resource-main">
                            @foreach($resource as $res)
                            <div class="resource shadow">
                                <div class="resource-cover">
                                    <a href="@if($res->demo_address)  {{$res->demo_address}}@else javascript:layer.msg(&#39;不好意思暂时没有演示地址&#39;)  @endif" target="_blank">
                                        <img src="{{$res->img}}" alt="{{$res->title}}" />
                                    </a>
                                </div>
                                <h1 class="resource-title"><a href="@if($res->demo_address)  {{$res->demo_address}}@else javascript:layer.msg(&#39;不好意思暂时没有演示地址&#39;)  @endif" target="_blank">{{$res->title}}</a></h1>
                                <p class="resource-abstract">{{$res->abstract}}</p>
                                <div class="resource-info">
                                    <span class="category"><i class="fa fa-tags fa-fw"></i>&nbsp;{{$res->created_at}}</span>
                                    <span class="author"><i class="fa fa-user fa-fw"></i>{{$res->abstract}}</span>
                                    <div class="clear"></div>
                                </div>
                                <div class="resource-footer">
                                    <a class="layui-btn layui-btn-small layui-btn-primary" href="@if($res->demo_address)  {{$res->demo_address}}@else javascript:layer.msg(&#39;不好意思暂时没有演示地址&#39;)  @endif" target="_blank"><i class="fa fa-eye fa-fw"></i>演示</a>
                                    <a class="layui-btn layui-btn-small layui-btn-primary" href="{{$res->download_url}}" target="_blank"><i class="fa fa-download fa-fw"></i>下载</a>
                                </div>
                            </div>

                            <!-- 清除浮动 -->
                            <div class="clear"></div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@section('js')








@endsection