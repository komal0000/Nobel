@extends('admin.layout.app')

@section('title')
    @if ($parent_id)
        <a href="{{ route('admin.blogCategory.index', ['type' => $type]) }}">
            @php
                $typeNames = [];
                foreach (\App\Helper::blog_types as $key => $value) {
                    $typeNames[$key] = ucfirst(str_replace('_', ' ', $value));
                }
                echo isset($typeNames[$type]) ? $typeNames[$type] . ' Categories' : 'Categories';
            @endphp
        </a> /
        @php
            $parents = \App\Helper::getParentRoute($parent_id, 'blog_categories', 'blogCategory', $type);
        @endphp
        @foreach ($parents as $parent)
            <a href="{{ route('admin.blogCategory.index', ['type' => $type, 'parent_id' => $parent->id]) }}">{{ $parent->title }}</a> /
        @endforeach
        <span>Sub Category</span> /
        <span>{{ isset($typeNames[$type]) ? rtrim($typeNames[$type], 's') : 'Content' }}</span>
    @else
        <a href="{{ route('admin.blogCategory.index', ['type' => $type]) }}">
            @php
                $typeNames = [];
                foreach (\App\Helper::blog_types as $key => $value) {
                    $typeNames[$key] = ucfirst(str_replace('_', ' ', $value));
                }
                echo isset($typeNames[$type]) ? $typeNames[$type] . ' Categories' : 'Categories';
            @endphp
        </a> /
        <span>{{ $blogCategory->title }}</span> /
        <span>{{ isset($typeNames[$type]) ? rtrim($typeNames[$type], 's') : 'Content' }}</span>
    @endif
@endsection
@section('btn')
    <a href="{{ route('admin.blogCategory.blog.add', ['blogCategory_id' => $blogCategory_id, 'type' => $type, 'parent_id' => $parent_id]) }}"
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
            @foreach ($blogs as $blog)
                <tr>
                    <td>{{ $blog->title }}</td>
                    <td>
                        <a href="{{ route('admin.blogCategory.blog.edit', ['blog_id' => $blog->id, 'parent_id' => $parent_id]) }}"
                            class="btn btn-warning btn-sm ">Edit</a>
                        <a href="{{ route('admin.blogCategory.blog.del', ['blog_id' => $blog->id]) }}"
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
