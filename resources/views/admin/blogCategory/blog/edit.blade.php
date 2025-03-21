@extends('admin.layout.app')

@section('title')
    @if ($parent_id)
        <a href="{{ route('admin.blogCategory.index', ['type' => $blogCategory->type]) }}">
            @if ($blogCategory->type == 1) Blogs Categories @elseif($blogCategory->type == 2) News Categories @else Event Categories @endif
        </a> /
        @php
            $parents = \App\Helpers\Helper::getParentRoute($parent_id, 'blog_Categories', 'blogCategory', $blogCategory->type);
        @endphp
        @foreach ($parents as $parent)
            <a href="{{ route('admin.blogCategory.index', ['type' => $blogCategory->type, 'parent_id' => $parent->id]) }}">{{ $parent->title }}</a> /
        @endforeach
        <span>Sub Category</span> /
        <span>{{ $blogCategory->title }}</span> /
        <a href="{{ route('admin.blogCategory.blog.add', ['blogCategory_id' => $blogCategory->id, 'type' => $blogCategory->type, 'parent_id' => $parent_id]) }}">
            @if ($blogCategory->type == 1) Blogs @elseif ($blogCategory->type == 2) News @else Events @endif
        </a> /
        <span>Edit</span>
    @else
        <a href="{{ route('admin.blogCategory.index', ['type' => $blogCategory->type]) }}">
            @if ($blogCategory->type == 1) Blogs Categories @elseif($blogCategory->type == 2) News Categories @else Event Categories @endif
        </a> /
        <span>{{ $blogCategory->title }}</span> /
        <a href="{{ route('admin.blogCategory.blog.index', ['blogCategory_id' => $blogCategory->id, 'type' => $blogCategory->type, 'parent_id' => $parent_id]) }}">
            @if ($blogCategory->type == 1) Blogs @elseif($blogCategory->type == 2) News @else Events @endif
        </a> /
        <span>Edit</span>
    @endif
@endsection

@section('content')
    <form action="{{ route('admin.blogCategory.blog.edit', ['blog_id' => $blog->id, 'parent_id' => $parent_id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="col-md-12">
                    <label for="image">Image <span style="color: red;">*</span></label>
                    <input type="file" name="image" id="image" class="form-control dropify" accept="image/*" data-default-file="{{ Storage::url($blog->image) }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="row d-flex align-items-end">
                    <div class="col-md-8 mb-2">
                        <label for="title">Title <span style="color: red;">*</span></label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ $blog->title }}">
                    </div>
                    <div class="col-md-4 mb-2 d-flex align-items-center">
                        <input type="hidden" name="is_featured" value="0">
                        <input type="checkbox" name="is_featured" value="1" class="form-check-input me-2" @if($blog->is_featured) checked @endif>
                        <label for="is_featured">Is Featured <span style="color: red;">*</span></label>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="date">Date</label>
                        <input type="date" name="date" id="date" class="form-control" value="{{ \App\Helper::convertIntegerToDate($blog->date) }}">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="loaction">Location</label>
                        <input type="text" name="location" id="location" class="form-control" value="{{ $blog->location }}" >
                    </div>
                </div>
                <div class="col-md-12 mb-2">
                    <label for="text">Text <span style="color: red;">*</span></label>
                    <input type="text" name="text" id="text" class="form-control" value="{{ $blog->text }}">
                </div>
                <div class="col-md-12 mb-2">
                    <label for="datas">Datas</label>
                    <textarea name="datas" id="datas" class="form-control">{{ $blog->datas }}</textarea>
                </div>
                <div class="col-md-12 mb-2 d-flex justify-content-end">
                    <button class="btn btn-success">
                        Update
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection
