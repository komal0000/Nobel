@extends('admin.layout.app')
@section('title')
    @if ($parent_id)
        <a href="{{ route('admin.downloadCategory.index') }}">Download Categories</a> /
        @php
            $parents = \App\Helpers\Helper::getParentRoute($parent_id);
        @endphp
        @foreach ($parents as $parent)
            <a href="{{ route('admin.downloadCategory.index', ['parent_id' => $parent->id]) }}">{{ $parent->title }}</a> /
        @endforeach
        <span>Sub Categories</span> /
        <span>Downloads</span>
    @else
        <a href="{{ route('admin.downloadCategory.index') }}">Download Categories</a> /
        <span>Downloads</span>
    @endif
@endsection
@section('btn')
    <a href="{{ route('admin.downloadCategory.download.add') }}" class="btn btn-primary">Add</a>
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
            @foreach ($downloads as $download)
                <tr>
                    <td>{{ $download->title }}</td>
                    <td>
                        <a href="{{ route('admin.downloadCategory.download.edit', ['download' => $download->id, 'parent_id' => $parent_id]) }}"
                            class="btn btn-warning btn-sm ">Edit</a>
                        <a href="{{ route('admin.downloadCategory.download.del', ['download' => $category->id, 'parent_id' => $parent_id]) }}"
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
