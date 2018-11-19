@extends('backend.layouts.layouts')
@section('content')
    <div class="box box-{{ isset($module) ? 'primary' : 'info' }}">
        <div class="box-header">
            <h3 class="box-title">{{ isset($module) ? '编辑' : '添加' }}模块</h3>
        </div>
        {!! Form::open(['url' => route('backend.modules.store'), 'method' => 'POST', 'class' => 'form-horizontal', 'role' => 'form']) !!}
            <!-- class include {'form-horizontal'|'form-inline'} -->
            <!-- /.box-header -->
            <div class="box-body">
                @if(isset($module))
                    <input type="hidden" name="id" value="{{ $module -> id }}">
                @endif
                <!--- Name Field --->
                <div class="form-group {{ $errors -> has('name') ? 'has-error' : '' }}">
                    <div class="col-md-offset-1 col-md-1">
                        {!! Form::label('name', '名称:', ['class' => 'control-label']) !!}
                    </div>
                    <div class="col-md-6">
                        {!! Form::text('name', isset($module) ? $module -> name : null, ['class' => 'form-control']) !!}
                    </div>
                    @if($errors -> has('name'))
                        <span class="help-block form-help-block"><strong>{{ $errors -> first('name') }}</strong></span>
                    @endif
                </div>

                <!--- Type Field --->
                <div class="form-group {{ $errors -> has('type') ? 'has-error' : '' }}">
                    <div class="col-md-offset-1 col-md-1">
                        {!! Form::label('type', '模块类型:', ['class' => 'control-label']) !!}
                    </div>
                    <div class="col-md-6">
                        <select name="type" class="form-control" id="type">
                            <option id='word' value="word">普通模块</option>
                            <option id='special' value="special">专题模块</option>
                            <option id='video' value="video">视频模块</option>
                            <option id='link' value="link">外链模块</option>
                            @if(isset($module))
                            <script>document.getElementById('{{ $module -> type }}').selected=true;</script>
                            @endif
                        </select>
                        @if($errors -> has('type'))
                            <span class="help-block form-help-block"><strong>{{ $errors -> first('type') }}</strong></span>
                        @endif
                    </div>
                </div>

                <!--- Thumbnail Field --->
                <div style="display:none" class="form-group {{ $errors -> has('thumbnail') ? 'has-error' : '' }}" id="moduleThumbnail">
                    {!! Form::label('thumbnail', '专题图(*):', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-6">
                        <input id="thumbnail-container" name="thumbnail-container" data-url="{{ route('backend.upload.thumbnail') }}" multiple type="file" accept="image/*">
                        <input type="hidden" id="thumbnail" name="thumbnail" value="{{ isset($module) ? $module -> thumb : '' }}">
                        @if($errors -> has('thumbnail'))
                            <span class="help-block form-help-block"><strong>{{ $errors -> first('thumbnail') }}</strong></span>
                        @endif
                    </div>
                </div>

                <!--- Code/Link Field --->
                <div class="form-group {{ $errors -> has('code') ? 'has-error' : '' }}" id="code">
                    <div class="col-md-offset-1 col-md-1">
                        {!! Form::label('code', '代码:', ['class' => 'control-label']) !!}
                    </div>
                    <div class="col-md-6">
                        {!! Form::text('code', isset($module) ? $module -> code : null, ['class' => 'form-control']) !!}
                    </div>
                    @if($errors -> has('code'))
                        <span class="help-block form-help-block"><strong>{{ $errors -> first('code') }}</strong></span>
                    @endif
                </div>

                <!--- Weight Field --->
                <div class="form-group {{ $errors -> has('weight') ? 'has-error' : '' }}">
                    <div class="col-md-offset-1 col-md-1">
                        {!! Form::label('weight', '权重:', ['class' => 'control-label']) !!}
                    </div>
                    <div class="col-md-6">
                        {!! Form::number('weight', isset($module) ? $module -> weight : 1000, ['class' => 'form-control']) !!}
                        @if($errors -> has('weight'))
                            <span class="help-block form-help-block"><strong>{{ $errors -> first('weight') }}</strong></span>
                        @endif
                    </div>
                </div>

                <!--- Desc Field --->
                <div class="form-group {{ $errors -> has('desc') ? 'has-error' : '' }}">
                    <div class="col-md-offset-1 col-md-1">
                        {!! Form::label('desc', '描述:', ['class' => 'control-label']) !!}
                    </div>
                    <div class="col-md-6">
                        {!! Form::textarea('desc', isset($module) ? $module -> desc : null, ['class' => 'form-control']) !!}
                        @if($errors -> has('desc'))
                            <span class="help-block form-help-block"><strong>{{ $errors -> first('desc') }}</strong></span>
                        @endif
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <div class="row">
                    <div class="col-md-offset-1 col-md-1">
                        <button type="submit" class="btn btn-sm btn-{{ isset($module) ? 'primary' : 'info' }}"><b>保存</b></button>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ route('backend.modules') }}" class="btn btn-sm btn-default pull-right"><b>返回</b></a>
                    </div>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
    <script>
        var postThumbnail = "{{ isset($module) ? $module -> thumb : "" }}";
    </script>
@endsection