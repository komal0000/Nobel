@extends('admin.layout.app')

@section('title')
    @if ($parent_id)
        <a href="{{ route('admin.blogCategory.index', ['type' => $type]) }}">
            @if ($type == 1)
                Blogs
            @else
                News
            @endif
        </a> /
        @php
            $parents = \App\Helpers\Helper::getParentRoute($parent_id, 'blog_Categories', 'blogCategory', $type);
        @endphp
        @foreach ($parents as $parent)
            <a
                href="{{ route('admin.blogCategory.index', ['type' => $type, 'parent_id' => $parent->id]) }}">{{ $parent->title }}</a>
            /
        @endforeach
        <span>Sub Category</span>
    @else
        <span>
            @if ($type == 1)
                Blogs
            @else
                News
            @endif
        </span>
    @endif
@endsection
@section('btn')
    <a href="{{ route('admin.blogCategory.add', ['type' => $type, 'parent_id' => $parent_id]) }}"
        class="btn btn-primary">Add</a>
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
            @foreach ($blogCategories as $category)
                <tr>
                    <td>{{ $category->title }}</td>
                    <td>
                        <a href="{{ route('admin.blogCategory.index', ['type' => $type, 'parent_id' => $category->id]) }}"
                            class="btn btn-info btn-sm">Sub Category</a>
                        <a href="{{ route('admin.blogCategory.edit', ['category' => $category->id, 'parent_id' => $category->id]) }}"
                            class="btn btn-warning btn-sm ">Edit</a>
                        <a href="{{ route('admin.blogCategory.del', ['category' => $category->id, 'parent_id' => $category->id]) }}"
                            class="btn btn-danger btn-sm">Delete</a>
                        <a
                            href="{{ route('admin.blogCategory.blog.index', ['category' => $category->id, 'type' => $type, 'parent_id' => $category->id]) }}">Manage Blogs</a>
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
