@extends('admin.layout.app')
@section('title')
    @if ($parent_id)
        <a href="{{ route('admin.blogCategory.index') }}">Blog Categories</a>
        @php
            $parents = \App\Helpers\Helper::getParentRoute($parent_id, 'blog_categories', 'BlogCategory');
        @endphp
        @foreach ($parents as $parent)
            <a href="{{ route('admin.BlogCategory.index', ['parent_id' => $parent->id]) }}">{{ $parent->title }}</a> /
        @endforeach
        <span>Sub Category</span> /
        <span>Add</span>
    @else
        <a href="{{ route('admin.blogCategory.index') }}">BlogCategory</a> /
        <span>Add</span>
    @endif
@endsection
@section('content')
    <form action="{{ route('admin.blogCategory.add', ['parent_id' => $parent_id]) }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-4">
                <label for="title" class="mb-2">Title <span style="color: red;">*</span></label>
                <input type="text" name="title" id="title" class="form-control">
            </div>
            <div class="col-md-4">
                <label for="type" class="mb-2">Type <span style="color: red;">*</span></label>
                <select name="type" id="type" class="form-control">
                    <option value="0">Blog</option>
                    <option value="1">News</option>
                </select>
            </div>
            <div class="col-md-4">
                <div class="d-flex align-items-end">
                    <button type="submit" class="btn btn-success">
                        Save
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection
