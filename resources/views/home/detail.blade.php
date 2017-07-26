@extends('home.layouts.layout')

@section('title', $detail->title.'-' )
@section('desc', $detail->abstract )
@section('keyword', $detail->keyword )

@section('style')
    <link href="{{asset('/templates/home/css/detail.css')}}" rel="stylesheet" />

@endsection

@section('content')
    <section id="intro">
        <div class="blog-body">
            <div class="blog-container">
                <blockquote class="layui-elem-quote sitemap layui-breadcrumb shadow" style="visibility: visible;">
                    <a href="/" title="网站首页">网站首页<span class="layui-box">&gt;</span></a>
                    <a href="{{url('/home/article')}}" title="文章专栏">文章专栏<span class="layui-box">&gt;</span></a>
                    <a><cite>{{$detail->title}}</cite></a>
                </blockquote>
                <div class="blog-main">
                    <div class="blog-main-left">
                        <!-- 文章内容（使用Kingeditor富文本编辑器发表的） -->
                        <div class="article-detail shadow">
                            <div class="article-detail-title">
                                {{$detail->title}}
                            </div>
                            <div class="article-detail-info">
                                <span>编辑时间：{{$detail->created_at}}</span>
                                <span>作者：{{$detail->author}}</span>
                                <span>浏览：{{$detail->clicks}}</span>
                                <span>评论：17</span>
                            </div>
                            {!! $detail->content !!}
                        </div>
                        <!-- 评论区域 -->
                        {{--<div class="blog-module shadow" style="box-shadow: 0 1px 8px #a6a6a6;">--}}
                        {{--<fieldset class="layui-elem-field layui-field-title" style="margin-bottom:0">--}}
                        {{--<legend>来说两句吧</legend>--}}
                        {{--<div class="layui-field-box">--}}
                        {{--<form class="layui-form blog-editor" action="">--}}
                        {{--<div class="layui-form-item">--}}
                        {{--<textarea name="editorContent" lay-verify="content" id="remarkEditor" placeholder="请输入内容" class="layui-textarea layui-hide"></textarea>--}}
                        {{--</div>--}}
                        {{--<div class="layui-form-item">--}}
                        {{--<button class="layui-btn" lay-submit="formRemark" lay-filter="formRemark">提交评论</button>--}}
                        {{--</div>--}}
                        {{--</form>--}}
                        {{--</div>--}}
                        {{--</fieldset>--}}
                        {{--<div class="blog-module-title">最新评论</div>--}}
                        {{--<ul class="blog-comment">--}}
                        {{--<li>--}}
                        {{--<div class="comment-parent">--}}
                        {{--<img src="../images/Absolutely.jpg" alt="absolutely" />--}}
                        {{--<div class="info">--}}
                        {{--<span class="username">Absolutely</span>--}}
                        {{--<span class="time">2017-03-18 18:46:06</span>--}}
                        {{--</div>--}}
                        {{--<div class="content">--}}
                        {{--我为大家做了模拟评论功能！还有，这个评论功能也可以改成和留言一样，但是目前没改，有兴趣可以自己改--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--</li>--}}
                        {{--</ul>--}}
                        {{--</div>--}}
                    </div>
                    <div class="blog-main-right">
                        @include('home.layouts.menulayout')
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    {{--评论--}}
    {{--    <script src="{{asset('/templates/home/js/detail.js')}}"></script>--}}

@endsection
