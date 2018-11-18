@extends('backend.layouts.layouts')
@section('content')
    <div class="box box-{{ isset($user) ? 'primary' : 'info' }}">
        <div class="box-header">
            <h3 class="box-title">{{ isset($user) ? '编辑' : '添加' }}用户</h3>
        </div>
        {!! Form::open(['url' => route('backend.systems.user.store'), 'method' => 'POST', 'class' => 'form-horizontal', 'role' => 'form']) !!}
            <!-- class include {'form-horizontal'|'form-inline'} -->
            <!-- /.box-header -->
            <div class="box-body">
                @if(isset($user))
                    <input type="hidden" name="id" value="{{ $user -> id }}">
                @endif
                <!--- Name Field --->
                <div class="form-group {{ $errors -> has('username') ? 'has-error' : '' }}">
                    <div class="col-md-offset-1 col-md-1">
                        {!! Form::label('username', '用户名:', ['class' => 'control-label']) !!}
                    </div>
                    <div class="col-md-6">
                        {!! Form::text('username', isset($user) ? $user -> username : null, ['class' => 'form-control']) !!}
                    </div>
                    @if($errors -> has('name'))
                        <span class="help-block form-help-block"><strong>{{ $errors -> first('name') }}</strong></span>
                    @endif
                </div>

                <!--- Code Field --->
                <div class="form-group {{ $errors -> has('name') ? 'has-error' : '' }}">
                    <div class="col-md-offset-1 col-md-1">
                        {!! Form::label('name', '姓名:', ['class' => 'control-label']) !!}
                    </div>
                    <div class="col-md-6">
                        {!! Form::text('name', isset($user) ? $user -> name : null, ['class' => 'form-control']) !!}
                    </div>
                    @if($errors -> has('name'))
                        <span class="help-block form-help-block"><strong>{{ $errors -> first('name') }}</strong></span>
                    @endif
                </div>

                <!--- department Field --->
                <div class="form-group {{ $errors -> has('department') ? 'has-error' : '' }}">
                    <div class="col-md-offset-1 col-md-1">
                        {!! Form::label('department', '部门:', ['class' => 'control-label']) !!}
                    </div>
                    <div class="col-md-6">
                        <select name="dep_id" class="form-control" id="dep_id">
                            @foreach($departments as $department)
                            <option id='{{ $department -> id }}' value="{{ $department -> id }}">{{ $department -> name }}</option>
                            @endforeach
                            @if(isset($user))
                            <script>document.getElementById('{{ $user -> dep_id }}').selected=true;</script>
                            @endif
                        </select>
                        @if($errors -> has('department'))
                            <span class="help-block form-help-block"><strong>{{ $errors -> first('department') }}</strong></span>
                        @endif
                    </div>
                </div>

                <!--- password Field --->
                <div class="form-group {{ $errors -> has('password') ? 'has-error' : '' }}">
                    <div class="col-md-offset-1 col-md-1">
                        {!! Form::label('password', '密码:', ['class' => 'control-label']) !!}
                    </div>
                    <div class="col-md-6">
                        {!! Form::password('password', ['class' => 'form-control']) !!}
                    </div>
                    @if($errors -> has('password'))
                        <span class="help-block form-help-block"><strong>{{ $errors -> first('password') }}</strong></span>
                    @endif
                </div>

                
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <div class="row">
                    <div class="col-md-offset-1 col-md-1">
                        <button type="submit" class="btn btn-sm btn-{{ isset($user) ? 'primary' : 'info' }}"><b>保存</b></button>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ route('backend.systems.user') }}" class="btn btn-sm btn-default pull-right"><b>返回</b></a>
                    </div>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
@endsection