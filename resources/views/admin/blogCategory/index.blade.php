@extends('admin.layout.app')

@section('title')
    @if ($parent_id)
        <a href="{{ route('admin.blogCategory.index') }}">BLog Categories</a> /
        @php
            $parents = \App\Helpers\Helper::getParentRoute($parent_id, 'blog_Categories', 'blogCategory');
        @endphp
        @foreach ($parents as $parent)
            <a href="{{ route('admin.blogCategory.index', ['parent_id' => $parent->id]) }}">{{ $parent->title }}</a> /
        @endforeach
        <span>Sub Category</span>
    @else
        <span>Blog Categories</span>
    @endif
@endsection
@section('btn')
    <a href="{{ route('admin.blogCategory.add', ['parent_id' => $parent_id]) }}" class="btn btn-primary">Add</a>
@endsection
@section('content')
    <table id="datatable" class="table table-striped" data-toggle="data-table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Type</th>
                <th>Manage</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($blogCategories as $category)
                <tr>
                    <td>{{ $category->title }}</td>
                    <td>{{ $category->type == 0 ? 'Blog' : 'News' }}</td>
                    <td>
                        <a href="{{ route('admin.blogCategory.index', ['parent_id' => $category->id]) }}"
                            class="btn btn-info btn-sm">Sub Category</a>
                        <a href="{{ route('admin.blogCategory.edit', ['category' => $category->id, 'parent_id' => $category->id]) }}"
                            class="btn btn-warning btn-sm ">Edit</a>
                        <a href="{{ route('admin.blogCategory.del', ['category' => $category->id, 'parent_id' => $category->id]) }}"
                            class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Title</th>
                <th>Type</th>
                <th>Manage</th>
            </tr>
        </tfoot>
    </table>
@endsection
