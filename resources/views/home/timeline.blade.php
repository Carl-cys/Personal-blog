@extends('home.layouts.layout')
@section('style')
    <link href="{{asset('/templates/home/css/timeline.css')}}" rel="stylesheet" />

@endsection

@section('hero')
    <section id="hero" class="scrollme">
        @forelse($figure as $fig)
            @if($request->path() == $fig->url)
                <div class="container-fluid element-img" style="background: url({{ url($fig->img)}}) no-repeat center center fixed;background-size: cover">
                    <div class="row">
                        <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2 vertical-align cover boost text-center" style="height: 619px;">
                            <div class="center-me animateme" data-when="exit" data-from="0" data-to="0.6" data-opacity="0" data-translatey="100">
                                <div>
                                    <h2>
                                        <a href="{{ url('home/timeline') }}/#intro" class="more scrolly" style="font-size: x-large;color:#fff;">
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
        <div class="blog-body" style="margin-top:-30px">
            <div class="blog-container">
                <div class="blog-main">
                    <div class="timeline-box shadow">
                        <div class="timeline-main">
                            <h1><i class="fa fa-clock-o"></i>时光轴<span> —— 记录生活点点滴滴</span></h1>
                            <div class="timeline-line"></div>
                            {{$year = ''}}
                            {{$m = ''}}
                            @forelse($timeline as $time)
                                <div class="timeline-year">
                                    @if( $year !== date( 'Y', strtotime($time->created_at )) )
                                        <h2> <a class="yearToggle" href="javascript:;">
                                                {{date( 'Y', strtotime($time->created_at ))}}年
                                            </a><i class="fa fa-caret-down fa-fw"></i>  </h2>
                                        {{$m = ''}}
                                    @endif
                                    {{!$year = date( 'Y', strtotime($time->created_at ))}}
                                    <div class="timeline-month">
                                        @if($m !== date( 'm'  , strtotime($time->created_at )))
                                            <h3 class=" animated fadeInLeft">
                                                <a class="monthToggle" href="javascript:;">
                                                    {{date( 'm'  , strtotime($time->created_at ))}}月
                                                </a><i class="fa fa-caret-down fa-fw"></i></h3>
                                        @endif
                                        {{!$m = date( 'm', strtotime($time->created_at ))}}
                                        <ul>
                                            <li class=" ">
                                                <div class="h4  animated fadeInLeft">
                                                    <p class="date">{{date( 'm'  , strtotime($time->created_at ))}}月{{date( 'd'  , strtotime($time->created_at ))}}日 {{date( 'H:i'  , strtotime($time->created_at ))}}</p>
                                                </div>
                                                <p class="dot-circle animated "><i class="fa fa-dot-circle-o"></i></p>
                                                <div class="content animated fadeInRight">{!! $time->content!!}</div>
                                                <div class="clear"></div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                @empty
                            @endforelse
                            <h1 style="padding-top:4px;padding-bottom:2px;margin-top:40px;"><i class="fa fa-hourglass-end"></i>THE END</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
@endsection