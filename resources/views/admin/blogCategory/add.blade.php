@extends('admin.layout.app')
@section('title')
    @if ($parent_id)
        <a href="{{ route('admin.blogCategory.index', ['type' => $type]) }}">
            @if ($type == 1) Blogs Categories @elseif($type == 2) News Categories @elseif($type == 3) Event Categories @else Update Categories @endif
        </a> /
        @php
            $parents = \App\Helper::getParentRoute($parent_id, 'blog_categories', 'blogCategory' , $type);
        @endphp
        @foreach ($parents as $parent)
            <a
                href="{{ route('admin.blogCategory.index', ['type' => $type, 'parent_id' => $parent->id]) }}">{{ $parent->title }}</a>
            /
        @endforeach
        <span>Sub Category</span> /
        <span>Add</span>
    @else
        <a href="{{ route('admin.blogCategory.index', ['type' => $type]) }}">
            @if ($type == 1) Blogs Categories @elseif($type == 2) News Categories  @elseif($type == 3) Event Categories @else Update Categories @endif
        </a> /
        <span>Add</span>
    @endif
@endsection
@section('content')
    <form action="{{ route('admin.blogCategory.add', ['type' => $type, 'parent_id' => $parent_id]) }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-4">
                <label for="title" class="mb-2">Title <span style="color: red;">*</span></label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>
            <div class="col-md-4 d-flex align-items-end ">
                <button type="submit" class="btn btn-success">
                    Save
                </button>
            </div>
        </div>
    </form>
@endsection
