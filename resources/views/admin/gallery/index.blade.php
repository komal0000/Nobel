@extends('admin.layout.app')
@section('title')
    <a href="{{ route('admin.gallery.type.index') }}">Gallery Types</a> /
    <span>{{ $type->title }}</span> /
    <span>Gallery</span>
@endsection
@section('btn')
    <a href="{{ route('admin.gallery.add', ['type_id' => $type->id]) }}" class="btn btn-primary">Add Gallery</a>
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
            @foreach ($galleries as $gallery)
                <tr>
                    <td>{{ $gallery->title }}</td>
                    <td>
                        <a href="{{ route('admin.gallery.edit', ['gallery_id' => $gallery->id]) }}"
                            class="btn btn-sm btn-warning">Edit</a>
                        <a href="{{ route('admin.gallery.del', ['gallery_id' => $gallery->id]) }}"
                            class="btn btn-sm btn-danger">Delete</a>
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
