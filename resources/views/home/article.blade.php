@extends('home.layouts.layout')

@section('title', '文章专栏'.'-' )

@section('style')
    <link href="{{asset('/templates/home/css/article.css')}}" rel="stylesheet" />
@endsection

@section('hero')
    <section id="hero" class="scrollme">
        @forelse($figure as $fig)
            @if(strpos($request->path(), $fig->url) !== false )
            {{--@if($request->path() == $fig->url)--}}
        <div class="container-fluid element-img" style="background: url({{$fig->img}}) no-repeat center center fixed;background-size: cover">
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2 vertical-align cover boost text-center" style="height: 619px;">
                    <div class="center-me animateme" data-when="exit" data-from="0" data-to="0.6" data-opacity="0" data-translatey="100">
                        <div>

                            <h2>
                                <a href="{{ url('home/article') }}/#intro" class="more scrolly"  style="font-size: x-large;">
                                    {{$fig->motto}}
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
            @endif
        @empty
            <p></p>
        @endforelse
    </section>
    <!-- Height spacing helper -->
    <div class="heightblock" style="height: 619px;"></div>
    <!-- // End height spacing helper -->
@endsection

@section('content')
    <section id="services">
        <div class="blog-body">
            <div class="blog-container">
                <blockquote class="layui-elem-quote sitemap layui-breadcrumb shadow" style="visibility: visible;">
                    <a href="/" title="网站首页">网站首页<span class="layui-box">&gt;</span></a>
                    <a><cite>文章专栏</cite></a>
                </blockquote>
                <div class="blog-main">
                    <div class="blog-main-left" id="flow">
					
                        @forelse($article as $key => $list)
						
                        <div class="article shadow">
                            <div class="article-left">
                                <img width='200' height="130" src="{{$list['img']}}" alt="{{$list['title']}}" />
                            </div>
                            <div class="article-right">
                                <div class="article-title">
                                    <a href="{{url('/home/detail/'.$list['id'])}}">{{$list['title']}}</a>
                                </div>
                                <div class="article-abstract">
                                    {{$list['abstract']}}
                                </div>
                            </div>
                            <div class="clear"></div>
                            <div class="article-footer">
                                <span><i class="fa fa-clock-o"></i>&nbsp;&nbsp;  {{date( 'Ymd', strtotime($list['created_at']))}}</span>
                                <span class="article-author"><i class="fa fa-user"></i>&nbsp;&nbsp;{{$list['author']}}</span>
                                <span><i class="fa fa-tag"></i>&nbsp;&nbsp;<a href="#">{{$cate[$key]}}</a></span>
                                <span class="article-viewinfo"><i class="fa fa-eye"></i>&nbsp;{{$list['clicks']}}</span>
                                <span class="article-viewinfo"><i class="fa fa-commenting"></i>&nbsp;0</span>
                            </div>

                        </div>
                            @empty
                            <div class="shadow" style="text-align:center;font-size:16px;padding:40px 15px;background:#fff;margin-bottom:15px;">
                               
                                未搜索到与【<span style="color: #FF5722;">
									@if($request->route('category') == 'category' )
											{{$searchcate}}
									@else
										
										{{$request->input('keywords')}}
									
									@endif
									</span>】有关的文章，随便看看吧！
                            </div>
                        @endforelse
                    </div>
                    <div class="blog-main-right">
                        <div class="blog-search">
                            <form  class="layui-form" action="{{ url('home/search') }}" method="get">
                                <div class="layui-form-item">
                                    <div class="search-keywords  shadow">
										
                                        <input type="text" name="keywords" lay-verify="required" placeholder="输入关键词搜索" autocomplete="off" class="layui-input">
                                    </div>
                                    <div class="search-submit  shadow">
                                        <button class="search-btn" lay-submit="formSearch" lay-filter="formSearch"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!--左边导航-->
                             @include('home.layouts.menulayout')
                        <div class="category-toggle"><i class="fa fa-chevron-left"></i></div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
		<input type = 'hidden' value="{{$request->url()}}" name="route" id="route">
    </section>
@endsection

@section('js')
	<script>
		var url = $('#route').val();	
		if(url == "https://mgocc.com/home/article"){
		layui.use('flow', function(){
					var $ = layui.jquery; //不用额外加载jQuery，flow模块本身是有依赖jQuery的，直接用即可。
					var flow = layui.flow;
					flow.lazyimg();
					flow.load({
						elem: '#flow'
						//指定列表容器
						,isLazyimg: true
						,isAuto: true,
						end: '没有更多了',
						mb: 200
						,done: function(page, next){ //到达临界点（默认滚动触发），触发下一页
							var lis = [];
							var pages;
							var str = '';
							if (page == 1) { //数据从第2页开始
								next(lis.join(''), page < 999999);
								return;
							}
							//以jQuery的Ajax请求为例，请求下一页数据（注意：page是从2开始返回）
							$.ajax({
								type: 'post',
								url : '/home/flow?page='+page,
								data:{ 'currentIndex': page ,'_token':'{{csrf_token()}}'}
								,datatype: 'json'
								,success: function (res){
								
									if( res.flow ){								
										lis.push(res.flow);
										pages = res.data.last_page;
										next(lis.join(''), page < pages);
									} else {
										
										next("没有更多了", 0);
										
									}
								}
							});
						}

					});
				});
		}
	</script>
@endsection