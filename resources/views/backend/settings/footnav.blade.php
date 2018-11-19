@extends('backend.layouts.layouts')
@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">底部导航管理</h3>
            <div class="box-tools">
                <a href="{{ route('backend.settings.footnav.add') }}" class="btn btn-sm btn-info"><b>添加</b></a>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table class="table table-striped text-center">
                <tbody>
                    <tr>
                        <th width="300">名称</th>
                        <th width="100">权重</th>
                        <th width="100">代码</th>
                        <th width="200">创建时间</th>
                        <th width="200">操作</th>
                    </tr>
                    @foreach($footnavs as $footnav)
                        <tr>
                            <td>{{ $footnav -> name }}</td>
                            <td>
                                {{ $footnav -> weight }}
                            </td>
                            <td>{{ $footnav -> code }}</td>
                            <td>{{ $footnav -> created_at }}</td>
                            <td>
                                <a href="{{ route('backend.settings.footnav.edit', ['id' => $footnav -> id]) }}" class="btn btn-xs btn-primary">编辑</a>
                                <a href="{{ route('backend.settings.footnav.delete', ['id' => $footnav -> id])  }}" class="btn btn-xs btn-danger">删除</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
@endsection