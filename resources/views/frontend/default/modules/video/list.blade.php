@extends('frontend.default.layouts.layouts')
@section('content')
    <div class="main-container">
        <section class="main">
            <div>
                <ol class="breadcrumb">
                    <li><i class="fa fa-map-marker"></i>
                        <a href="">首页</a>
                    </li>
                    <li class="active">廉政视听</li>
                </ol>
            </div>
            <ul class="video-list">
                @foreach($contents as $content)
                <li>
                    <h3><a href="{{ route('module.detail', ['module' => $code, 'id' => $content -> id]) }}">{{ $content -> title }}</a></h3>
                    <div>
                        <div style="background-image: url('1{{ $content -> thumb }}'),url('http://img2.imgtn.bdimg.com/it/u=1381865013,3042801585&fm=26&gp=0.jpg')">
                            <a href="{{ route('module.detail', ['module' => $code, 'id' => $content -> id]) }}"><img src="/images/site/play.png" alt="{{ $content -> title }}"></a>
                        </div>
                        <div>
                            <h5>{{ $content -> title }}</h5>
                            <p>{{ $content -> abst }}</p>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </section>
    </div>
@endsection