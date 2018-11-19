@extends('frontend.default.layouts.layouts')
@section('content')
    <div class="main-container">
        <section class="main">
            <div>
                <ol class="breadcrumb">
                    <li><i class="fa fa-map-marker"></i>
                        <a href="{{ route('index') }}">首页</a>
                    </li>
                    <li class="active">{{ $module }}</li>
                </ol>
            </div>
            <ul class="special-list">
                <li>
                @foreach($modules as $key => $module)
                    <a href="{{ route('module.list', ['module' => $module -> code]) }}">
                        <img src="{{ $module -> thumb }}">
                        <!-- <p>dbgnhg</p> -->
                    </a>
                    @if(($key+1)%3==0)
                    </li><li>
                    @endif
                @endforeach
                </li>
            </ul>
        </section>
    </div>
@endsection