@extends('admin.layout.app')
@section('title')
    @if ($parent_id)
        <a href="{{ route('admin.blogCategory.index', ['type' => $BlogCategory->type]) }}">
            @php
            $typeNames = [];
            foreach (\App\Helper::blog_types as $key => $value) {
                $typeNames[$key] = ucfirst(str_replace('_', ' ', $value));
            }
            echo isset($typeNames[$BlogCategory->type]) ? $typeNames[$BlogCategory->type] . ' Categories' : 'Categories';
            @endphp
        </a> /
        @php
            $parents = \App\Helper::getParentRoute($parent_id, 'blog_categories', 'blogCategory', $BlogCategory->type);
        @endphp
        @foreach ($parents as $parent)
            <a
                href="{{ route('admin.blogCategory.index', ['type' => $BlogCategory->type, 'parent_id' => $parent->id]) }}">{{ $parent->title }}</a>
            /
        @endforeach
        <span>Sub Category</span> /
        <span>Edit</span>
    @else
        <a href="{{ route('admin.blogCategory.index', ['type' => $BlogCategory->type]) }}">
            @php
                $typeNames = [];
                foreach (\App\Helper::blog_types as $key => $value) {
                    $typeNames[$key] = ucfirst(str_replace('_', ' ', $value));
                }
                echo isset($typeNames[$BlogCategory->type]) ? $typeNames[$BlogCategory->type] . ' Categories' : 'Categories';
            @endphp
        </a> /
        <span>Edit</span>
    @endif
@endsection
@section('content')
    <form action="{{ route('admin.blogCategory.edit', ['category' => $BlogCategory->id, 'parent_id' => $parent_id]) }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-4">
                <label for="title">Title <span style="color: red;">*</span></label>
                <input type="text" name="title" id="title" class="form-control" value="{{ $BlogCategory->title }}">
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button class="btn btn-warning"> Update </button>
            </div>
        </div>
    </form>
@endsection
