@extends('admin.layout.app')

@section('title')
    @if ($parent_id)
        <a href="{{ route('admin.download.index') }}">Download Categories</a> /
        @php
            $parents = \App\Helpers\Helper::getParentRoute($parent_id);
        @endphp
        @foreach ($parents as $parent)
            <a href="{{ route('admin.download.index', ['parent_id' => $parent->id]) }}">{{ $parent->title }}</a> /
        @endforeach
        <span>Sub Category</span>
    @else
        <span>Download Category</span>
    @endif
@endsection
@section('btn')
    <a href="{{ route('admin.downloadCategory.add', ['parent_id' => $parent_id]) }}" class="btn btn-primary">Add</a>
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
            @foreach ($downloadcategories as $category)
                <tr>
                    <td>{{ $category->title }}</td>
                    <td>
                        <a href="{{ route('admin.download.index', ['parent_id' => $category->id]) }}"
                            class="btn btn-info btn-sm">Sub Category</a>
                        <a href="{{ route('admin.download.edit', ['category' => $category->id, 'parent_id' => $category->id]) }}"
                            class="btn btn-warning btn-sm ">Edit</a>
                        <a href="{{ route('admin.download.del', ['category' => $category->id, 'parent_id' => $category->id]) }}"
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
