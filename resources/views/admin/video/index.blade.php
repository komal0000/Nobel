@extends('admin.layout.app')
@section('title')
  <a href="{{ route('admin.video.type.index') }}">Video Types</a> /
  <span>{{$videoType->title}}</span> /
  <span>Videos</span>
@endsection
@section('btn')
    <a href="{{ route('admin.video.add') }}" class="btn btn-primary">Add</a>
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
                <th>Manage</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($Videos as $video)
                <tr>
                    <td>
                        {{ $video->title }}
                    </td>
                    <td>
                        <a href="{{ route('admin.technology.edit', ['technology_id' => $technology->id]) }}"
                            class="btn btn-sm btn-warning">Edit</a>
                        <a href="{{ route('admin.technology.del', ['technology_id' => $technology->id]) }}"
                            class="btn btn-sm btn-danger">Delete</a>
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
