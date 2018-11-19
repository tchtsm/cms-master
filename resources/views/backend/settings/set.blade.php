@extends('backend.layouts.layouts')
@section('content')
    <div class="box box-{{ is_null($sets) ? 'info' : 'primary' }}">
        <div class="box-header with-border">
            <h3 class="box-title">编辑内容</h3>
        </div>

        {!! Form::open(['url'=>route('backend.settings.set'), 'method'=>'POST', 'class'=>'form-horizontal','role'=>'form']) !!}

            <div class="form-group {{ $errors -> has('$sets') ? 'has-error' : '' }}">
                <div class="col-md-offset-1 col-md-1">
                    {!! Form::label('title', '标题:', ['class' => 'control-label']) !!}
                </div>
                <div class="col-md-6">
                    {!! Form::text('title', $sets -> title, ['class' => 'form-control']) !!}
                </div>
                @if($errors -> has('title'))
                    <span class="help-block form-help-block"><strong>{{ $errors -> first('title') }}</strong></span>
                @endif
            </div>

            <div class="form-group {{ $errors -> has('foot') ? 'has-error' : '' }}">
                <div class="col-md-offset-1 col-md-1">
                    {!! Form::label('foot', '底部:', ['class' => 'control-label']) !!}
                </div>
                <div class="col-md-6">
                    {!! Form::text('foot', $sets -> foot, ['class' => 'form-control']) !!}
                </div>
                @if($errors -> has('foot'))
                    <span class="help-block form-help-block"><strong>{{ $errors -> first('foot') }}</strong></span>
                @endif
            </div>

            <div class="box-footer">
                <div class="row">
                    <div class="col-md-offset-1 col-md-1">
                        <button type="submit" class="btn btn-sm btn-info}}"><b>保存</b></button>
                    </div>
                </div>
            </div>

    </div>
@endsection