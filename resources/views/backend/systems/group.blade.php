@extends('backend.layouts.layouts')
@section('content')
<ul class="list-group">
	@foreach($departments as $department)
    <li class="list-group-item">{{ $department->name }}</li>
    @endforeach
</ul>
@endsection