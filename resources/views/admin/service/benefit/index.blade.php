@extends('admin.layout.app')
@section('title')
    <a href="{{ route('admin.service.index') }}">Services</a> /
    <span>{{ $service->title }}</span> /
    <span>Benefits</span>
@endsection
@section('btn')
    <a href="{{ route('admin.service.benefit.add', ['service_id' => $service->id]) }}" class="btn btn-primary">Add</a>
@endsection
@section('content')
    <table id="datatable" class="table table-striped" data-toggle="data-table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($benefits as $benefit)
                <tr>
                    <td>{{ $benefit->title }}</td>
                    <td>
                        <a href="{{ route('admin.service.benefit.edit', ['benefit_id' => $benefit->id]) }}"
                            class="btn btn-warning btn-sm">Edit</a>
                        <a href="{{ route('admin.service.benefit.del', ['benefit_id' => $benefit->id]) }}"
                            class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Title</th>
                <th>Actions</th>
            </tr>
        </tfoot>
    </table>
@endsection
