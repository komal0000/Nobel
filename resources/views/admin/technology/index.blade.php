@extends('admin.layout.app')
@section('title')
    <span>Technology</span>
@endsection
@section('btn')
    <a href="{{ route('admin.technology.add') }}" class="btn btn-primary">Add</a>
@endsection
@section('css')
    <style>
        .update_input {
            border: none;
            padding: 0px;
        }
    </style>
@endsection
@section('content')
    <table id="datatable" class="table table-striped" data-toggle="data-table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Short Description</th>
                <th>Manage</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($technologies as $technology)
                <tr>
                    <td>
                        {{ $technology->title }}"
                    </td>
                    <td>
                        {{ $technology->short_description }}
                    </td>
                    <td>
                        <a href="{{ route('admin.technology.edit', ['technology_id' => $technology->id]) }}"
                            class="btn btn-sm btn-warning">Update</a>
                        <a href="{{ route('admin.technology.del', ['technology_id' => $technology->id]) }}"
                            class="btn btn-sm btn-danger">Delete</a>
                        <a href="{{ route('admin.technology.section.index', ['technology_id' => $technology->id]) }}"
                            class="btn btn-info"> Manage Section </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Title</th>
                <th>Short Description</th>
                <th>Manage</th>
            </tr>
        </tfoot>
    </table>
@endsection
