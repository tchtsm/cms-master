@extends('backend.layouts.layouts')
@section('content')
    <div class="box box-{{ isset($link) ? 'primary' : 'info' }}">
        <div class="box-header">
            <h3 class="box-title">{{ isset($link) ? '编辑' : '添加' }}底部导航</h3>
        </div>
        {!! Form::open(['url' => route('backend.settings.link.store'), 'method' => 'POST', 'class' => 'form-horizontal', 'role' => 'form']) !!}
            <!-- class include {'form-horizontal'|'form-inline'} -->
            <!-- /.box-header -->
            <div class="box-body">
                @if(isset($link))
                    <input type="hidden" name="id" value="{{ $link -> id }}">
                @endif
                <!--- Name Field --->
                <div class="form-group {{ $errors -> has('name') ? 'has-error' : '' }}">
                    <div class="col-md-offset-1 col-md-1">
                        {!! Form::label('name', '名称:', ['class' => 'control-label']) !!}
                    </div>
                    <div class="col-md-6">
                        {!! Form::text('name', isset($link) ? $link -> name : null, ['class' => 'form-control']) !!}
                    </div>
                    @if($errors -> has('name'))
                        <span class="help-block form-help-block"><strong>{{ $errors -> first('name') }}</strong></span>
                    @endif
                </div>

                <!--- Link Field --->
                <div class="form-group {{ $errors -> has('link') ? 'has-error' : '' }}">
                    <div class="col-md-offset-1 col-md-1">
                        {!! Form::label('link', '链接:', ['class' => 'control-label']) !!}
                    </div>
                    <div class="col-md-6">
                        {!! Form::text('link', isset($link) ? $link -> link : null, ['class' => 'form-control']) !!}
                    </div>
                    @if($errors -> has('link'))
                        <span class="help-block form-help-block"><strong>{{ $errors -> first('link') }}</strong></span>
                    @endif
                </div>

                <!--- Weight Field --->
                <div class="form-group {{ $errors -> has('weight') ? 'has-error' : '' }}">
                    <div class="col-md-offset-1 col-md-1">
                        {!! Form::label('weight', '权重:', ['class' => 'control-label']) !!}
                    </div>
                    <div class="col-md-6">
                        {!! Form::number('weight', isset($link) ? $link -> weight : 1000, ['class' => 'form-control']) !!}
                        @if($errors -> has('weight'))
                            <span class="help-block form-help-block"><strong>{{ $errors -> first('weight') }}</strong></span>
                        @endif
                    </div>
                </div>

                <!--- parent_id Field --->
                <div class="form-group {{ $errors -> has('parent_id') ? 'has-error' : '' }}">
                    <div class="col-md-offset-1 col-md-1">
                        {!! Form::label('parent_id', '导航:', ['class' => 'control-label']) !!}
                    </div>
                    <div class="col-md-6">
                        <select name="parent_id" class="form-control" id="parent_id">
                            @foreach($footnavs as $footnav)
                            <option id='{{ $footnav -> id }}' value="{{ $footnav -> id }}">{{ $footnav -> name }}</option>
                            @endforeach
                            @if(isset($link))
                            <script>document.getElementById('{{ $link -> parent_id }}').selected=true;</script>
                            @endif
                        </select>
                        @if($errors -> has('parent_id'))
                            <span class="help-block form-help-block"><strong>{{ $errors -> first('parent_id') }}</strong></span>
                        @endif
                    </div>
                </div>

            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <div class="row">
                    <div class="col-md-offset-1 col-md-1">
                        <button type="submit" class="btn btn-sm btn-{{ isset($link) ? 'primary' : 'info' }}"><b>保存</b></button>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ route('backend.settings.link') }}" class="btn btn-sm btn-default pull-right"><b>返回</b></a>
                    </div>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
@endsection