@extends('backend.layouts.layouts')
@section('content')
    <div class="box box-{{ is_null($sets) ? 'info' : 'primary' }}">
        <div class="box-header with-border">
            <h3 class="box-title">{{ is_null($sets) ? '添加' : '编辑'}}内容</h3>
        </div>

        {!! Form::open(['url'=>route('backend.settings.set'), 'method'=>'POST', 'class'=>'form-horizontal','role'=>'form']) !!}

            @if(!is_null($sets))
                <input type="" name="">
            @endif

    </div>
@endsection