@extends('Home.layouts.layout')
@section('style')
    <link href="{{asset('/templates/home/css/timeline.css')}}" rel="stylesheet" />

@endsection

@section('hero')
    <section id="hero" class="scrollme">
        @forelse($figure as $fig)
            @if($request->path() == $fig->url)
                <div class="container-fluid element-img" style="background: url({{$fig->img}}) no-repeat center center fixed;background-size: cover">
                    <div class="row">
                        <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2 vertical-align cover boost text-center" style="height: 619px;">
                            <div class="center-me animateme" data-when="exit" data-from="0" data-to="0.6" data-opacity="0" data-translatey="100">
                                <div>

                                    <h2>
                                        <a href="https://www.iphpt.com/#intro" class="more scrolly" style="font-size: x-large;">
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
    <section id="intro">

        {!! $about->content!!}

    </section>
@endsection

@section('js')

@endsection