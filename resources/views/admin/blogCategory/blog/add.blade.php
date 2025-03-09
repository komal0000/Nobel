@extends('admin.layout.app')

@section('title')
    @if ($parent_id)
        <a href="{{ route('admin.blogCategory.index', ['type' => $type]) }}">
            @if ($type == 1)
                Blogs Categories
            @else
                News Categories
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
        <span>Sub Category</span> /
        <span>Galleries</span>
    @else
        <a href="{{ route('admin.blogCategory.index', ['type' => $type]) }}">
            @if ($type == 1)
                Blogs Categories
            @else
                News Categories
            @endif
        </a> /
        <span>{{ $blogCategory->title }}</span> /
        <span>Galleries</span>
    @endif
@endsection
@section('content')
    <form
        action="{{ route('admin.blogCategory.blog.add', ['blogCategory_id' => $blogCategory->id, 'type' => $type, 'parent_id' => $parent_id]) }}"
        method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="col-md-12">
                    <label for="image">Image</label>
                    <input type="file" name="image" id="image" class="form-control dropify" accept="image/*">
                </div>
            </div>
            <div class="col-md-6">
                <div class="row d-flex align-items-end">
                    <div class="col-md-8 mb-2">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" class="form-control">
                    </div>
                    <div class="col-md-4 mb-2 d-flex align-items-center">
                        <input type="checkbox" name="is_featured" id="is_featured" class="form-check-input me-2">
                        <label for="is_featured">Is Featured</label>
                    </div>
                </div>
                <div class="col-md-12 mb-2">
                    <label for="text">Text</label>
                    <input type="text" name="text" id="text" class="form-control">
                </div>
                <div class="col-md-12 mb-2">
                    <label for="datas">Datas</label>
                    <textarea name="datas" id="datas" class="form-control"></textarea>
                </div>
                <div class="col-md-12 mb-2 d-flex justify-content-end">
                    <button class="btn btn-success">
                        Save
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection
