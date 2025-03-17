@extends('admin.layout.app')
@section('title')
    <span>Leaderships</span>
@endsection
@section('btn')
    <a href="{{ route('admin.leadership.add') }}" class="btn btn-primary">Add</a>
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
            @foreach ($leaderships as $leadership)
                <tr>
                    <td>{{ $leadership->title }}</td>
                    <td>
                        <a href="{{ route('admin.leadership.edit', ['leaderships_id' => $leadership->id]) }}"
                            class="btn btn-warning btn-sm ">Edit</a>
                        <a href="{{ route('admin.leadership.del', ['leaderships_id' => $leadership->id]) }}"
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
