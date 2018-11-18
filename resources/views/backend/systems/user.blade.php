@extends('backend.layouts.layouts')
@section('content')
<div class="box">
        <div class="box-header">
            <h3 class="box-title">用户管理</h3>
            <div class="box-tools">
                <a href="{{ route('backend.systems.user.add') }}" class="btn btn-sm btn-info"><b>添加</b></a>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table class="table table-striped text-center">
                <tbody>
                    <tr>
                        <th>用户名</th>
                        <th>姓名</th>
                        <th>所属部门</th>
                        <th>操作</th>
                    </tr>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user -> username }}</td>
					    	<td>{{ $user -> name }}</td>
					    	<td>{{ $user -> department }}</td>
                            <td>
                                <a href="{{ route('backend.systems.user.edit', ['id' => $user -> id]) }}" class="btn btn-xs btn-primary">编辑</a>
                                <a href="{{ route('backend.systems.user.delete', ['id' => $user -> id])  }}" class="btn btn-xs btn-danger">删除</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>

@endsection