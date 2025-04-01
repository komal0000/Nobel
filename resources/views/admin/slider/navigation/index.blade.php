@extends('admin.layout.app')
@section('title')
    <span>Slider Navigation</span>
@endsection
@section('btn')
    <a href="{{ route('admin.slider.navigation.add') }}" class="btn btn-primary">Add</a>
@endsection
@section('content')
    <table id="datatable" class="table table-striped" data-toggle="data-table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Manage</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($navigations as $navigation)
                <tr>
                    <td>{{ $navigation->title }}</td>
                    <td>
                        <a href="{{ route('admin.slider.navigation.edit', ['navigation_id' => $navigation->id]) }}"
                            class="btn btn-warning btn-sm">Edit</a>
                        <a href="{{ route('admin.slider.navigation.del', ['navigation_id' => $navigation->id]) }}"
                            class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Title</th>
                <th>Manage</th>
            </tr>
        </tfoot>
    </table>
@endsection
