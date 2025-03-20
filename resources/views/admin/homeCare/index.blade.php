@extends('admin.layout.app')
@section('title')
    <span>Home care</span>
@endsection
@section('btn')
    <a href="{{ route('admin.homeCare.add') }}" class="btn btn-primary">Add</a>
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
            @foreach ($HomeCareData as $data)
                <tr>
                    <td>{{ $data->title }}</td>
                    <td>
                        <a href="{{ route('admin.homeCare.edit', ['homeCare_id' => $data->id]) }}"
                            class="btn btn-warning btn-sm">Edit</a>
                        <a href="{{ route('admin.homeCare.del', ['homeCare_id' => $data->id]) }}"
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
