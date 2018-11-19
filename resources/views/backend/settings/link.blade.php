@extends('backend.layouts.layouts')
@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">底部导航管理</h3>
            <div class="box-tools">
                <a href="{{ route('backend.settings.link.add') }}" class="btn btn-sm btn-info"><b>添加</b></a>
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
                        <th width="200">所属导航</th>
                        <th width="200">创建时间</th>
                        <th width="200">操作</th>
                    </tr>
                    @foreach($links as $link)
                        <tr>
                            <td>{{ $link -> name }}</td>
                            <td>
                                {{ $link -> weight }}
                            </td>
                            <td>{{ $link -> link }}</td>
                            <td>{{ $link -> nav }}</td>
                            <td>{{ $link -> created_at }}</td>
                            <td>
                                <a href="{{ route('backend.settings.link.edit', ['id' => $link -> id]) }}" class="btn btn-xs btn-primary">编辑</a>
                                <a href="{{ route('backend.settings.link.delete', ['id' => $link -> id])  }}" class="btn btn-xs btn-danger">删除</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
@endsection