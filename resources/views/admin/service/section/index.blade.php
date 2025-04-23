@extends('admin.layout.app')
@section('title')
    <a href="{{ route('admin.service.index') }}">Services</a> /
    <span>{{ $service->title }}</span> /
    <span>Sections</span>
@endsection
@section('btn')
    <a href="{{ route('admin.service.section.add', ['service_id' => $service->id]) }}" class="btn btn-primary">Add</a>
@endsection
@section('content')
    <table id="datatable" class="table table-striped" data-toggle="data-table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Image Placement</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sections as $section)
                <tr>
                    <td>{{ $section->title }}</td>
                    <td>{{ Str::limit($section->short_desc1, 100) }}</td>
                    <td>{{ $section->image_placement }}</td>
                    <td>
                        <a href="{{ route('admin.service.section.edit', ['section_id' => $section->id]) }}"
                            class="btn btn-warning btn-sm">Edit</a>
                        <a href="{{ route('admin.service.section.del', ['section_id' => $section->id]) }}"
                            class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Image Placement</th>
                <th>Actions</th>
            </tr>
        </tfoot>
    </table>
@endsection
