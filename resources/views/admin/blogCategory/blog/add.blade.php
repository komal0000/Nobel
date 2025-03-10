@extends('admin.layout.app')

@section('title')
    @if ($parent_id)
        <a href="{{ route('admin.blogCategory.index', ['type' => $type]) }}">
            @if ($type == 1) Blogs Categories @elseif ($type == 2) News Categories @else Event Categories @endif
        </a> /
        @php
            $parents = \App\Helpers\Helper::getParentRoute($parent_id, 'blog_Categories', 'blogCategory', $type);
        @endphp
        @foreach ($parents as $parent)
            <a href="{{ route('admin.blogCategory.index', ['type' => $type, 'parent_id' => $parent->id]) }}">{{ $parent->title }}</a> /
        @endforeach
        <span>Sub Category</span> /
        <span>{{ $blogCategory->title }}</span> /
        <a href="{{ route('admin.blogCategory.blog.add', ['blogCategory_id' => $blogCategory->id, 'type' => $type, 'parent_id' => $parent_id]) }}">
            @if ($type == 1) Blogs @elseif ($type == 2) News @else Events @endif
        </a> /
        <span>Add</span>
    @else
        <a href="{{ route('admin.blogCategory.index', ['type' => $type]) }}">
            @if ($type == 1) Blogs Categories @elseif ($type == 2) News Categories @else Event Categories @endif
        </a> /
        <span>{{ $blogCategory->title }}</span> /
        <a href="{{ route('admin.blogCategory.blog.index', ['blogCategory_id' => $blogCategory->id, 'type' => $type, 'parent_id' => $parent_id]) }}">
            @if ($type == 1) Blogs @elseif ($type == 2) News @else Events @endif
        </a> /
        <span>Add</span>
    @endif
@endsection
@section('content')
    <form action="{{ route('admin.blogCategory.blog.add', ['blogCategory_id' => $blogCategory->id, 'type' => $type, 'parent_id' => $parent_id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="col-md-12">
                    <label for="image">Image <span style="color: red;">*</span></label>
                    <input type="file" name="image" id="image" class="form-control dropify" accept="image/*">
                </div>
            </div>
            <div class="col-md-6">
                <div class="row d-flex align-items-end">
                    <div class="col-md-8 mb-2">
                        <label for="title">Title <span style="color: red;">*</span></label>
                        <input type="text" name="title" id="title" class="form-control">
                    </div>
                    <div class="col-md-4 mb-2 d-flex align-items-center">
                        <input type="hidden" name="is_featured" value="0">
                        <input type="checkbox" name="is_featured" value="1" class="form-check-input me-2">
                        <label for="is_featured">Is Featured <span style="color: red;">*</span></label>
                    </div>
                </div>
                <div class="col-md-12 mb-2">
                    <label for="text">Text <span style="color: red;">*</span></label>
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
