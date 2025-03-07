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
            $parents = \App\Helpers\Helper::getParentRoute($parent_id, 'blog_categories', 'BlogCategory');
        @endphp
        @foreach ($parents as $parent)
            <a
                href="{{ route('admin.blogCategory.index', ['type' => $type, 'parent_id' => $parent->id]) }}">{{ $parent->title }}</a>
            /
        @endforeach
        <span>Sub Category</span> /
        <span>Edit</span>
    @else
        <a href="{{ route('admin.blogCategory.index', ['type' => $type]) }}">
            @if ($type == 1)
                Blogs
            @else
                News
            @endif
        </a> /
        <span>Edit</span>
    @endif
@endsection
@section('content')
    <form action="{{ route('admin.blogCategory.edit', ['category' => $blogCategory->id, 'parent_id' => $parent_id]) }}">
        @csrf
        <div class="row">
            <div class="col-md-4">
                <label for="title">Title <span style="color: red;">*</span></label>
                <input type="text" name="title" id="title" class="form-control" value="{{ $blogCategory->title }}">
            </div>
            <div class="col-md-4">
                <bnt class="btn btn-success">
                    Update
                </bnt>
            </div>
        </div>
    </form>
@endsection
