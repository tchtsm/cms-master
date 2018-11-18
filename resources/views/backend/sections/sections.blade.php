@extends('backend.layouts.layouts')
@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">首页管理</h3>
            <div class="box-tools">
                <button data-toggle="modal" data-target="#add-sections" class="btn btn-sm btn-info" {{ empty($modules) ? 'disabled' : '' }}><b>添加</b></button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col-md-4">
                    <table class="table table-striped table-hover text-center">
                        <tbody>
                            <tr>
                                <th width="300">名称</th>
                                <th width="100">权重</th>
                                <th width="200">首页位置</th>
                                <th width="100">操作</th>
                            </tr>
                            @foreach($sections as $value)
                                <tr class="tr-pointer">
                                    <td class="sections-tr" data-id="{{ $value -> id }}" data-url="{{ route('backend.sections') }}">{{ $value -> name }}</td>
                                    <td class="sections-tr" data-id="{{ $value -> id }}" data-url="{{ route('backend.sections') }}">{{ $value -> weight }}</td>
                                    <td class="sections-tr" data-id="{{ $value -> id }}" data-url="{{ route('backend.sections') }}">{{ $value -> position == 0 ? '左' : '右' }}</td>
                                    <td><a href="{{ route('backend.sections.delete', ['id' => $value -> id]) }}" class="btn btn-xs btn-danger">删除</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6" style="border: 2px red solid; padding: 10px 20px">
                    {!! Form::open(['url' => route('backend.sections.store'), 'method' => 'post', 'class' => 'form-horizontal', 'role' => 'form']) !!}
                        <!-- class include {'form-horizontal'|'form-inline'} -->
                        <!--- Name Field --->
                        <div class="form-group">
                            <div class="col-md-2">
                                {!! Form::label('name', '名称:', ['class' => 'control-label']) !!}
                            </div>
                            <div class="col-md-6">
                                {!! Form::text('name', null, ['class' => 'form-control', 'readonly']) !!}
                            </div>
                        </div>

                        <!--- Weight Field --->
                        <div class="form-group">
                            <div class="col-md-2">
                                {!! Form::label('weight', '权重:', ['class' => 'control-label']) !!}
                            </div>
                            <div class="col-md-6">
                                {!! Form::text('weight', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <!--- Position Field --->
                        <div class="form-group">
                            <div class="col-md-2">
                                {!! Form::label('position', '位置:', ['class' => 'control-label']) !!}
                            </div>
                            <div class="col-md-6 radio">
                                <label><input type="radio" name="position" id="position" value="0"> 左</label>
                                &nbsp;
                                <label><input type="radio" name="position" id="position" value="1"> 右</label>
                            </div>
                        </div>
                        <input type="hidden" name="m_id" id="m_id" value="-999">
                        <input type="hidden" name="id" id="id" value="-999">
                        <div class="form-group">
                            <div class="col-md-offset-2 col-md-6">
                                <button type="submit" class="btn btn-sm btn-primary section-edit-form-submit" disabled="">保存</button>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <!-- /.box-body -->
    </div>

    <div class="modal fade" id="add-sections">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">添加首页板块</h4>
                </div>
                {!! Form::open(['url' => route('backend.sections.store'), 'method' => 'post', 'class' => 'form-horizontal', 'role' => 'form']) !!}
                    <!-- class include {'form-horizontal'|'form-inline'} -->
                    <div class="modal-body">
                        <!--- M_id Field --->
                        <div class="form-group">
                            <div class="col-md-2">
                                {!! Form::label('modal_m_id', '模块:', ['class' => 'control-label']) !!}
                            </div>
                            <div class="col-md-10">
                                {!! Form::select('modal_m_id', $modules, null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <!--- Weight Field --->
                        <div class="form-group">
                            <div class="col-md-2">
                                {!! Form::label('modal_weight', '权重:', ['class' => 'control-label']) !!}
                            </div>
                            <div class="col-md-10">
                                {!! Form::number('modal_weight', 1000, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <!--- Weight Field --->
                        <div class="form-group">
                            <div class="col-md-2">
                                {!! Form::label('modal-position', '位置:', ['class' => 'control-label']) !!}
                            </div>
                            <div class="col-md-10 radio">
                                <label><input type="radio" name="modal_position" id="modal-position" value="0" checked> 左</label>
                                &nbsp;
                                <label><input type="radio" name="modal_position" id="modal-position" value="1"> 右</label>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary pull-left">保存</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    </div>
                {!! Form::close() !!}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
@endsection