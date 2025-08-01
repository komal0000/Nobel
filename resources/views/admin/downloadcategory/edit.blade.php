@extends('admin.layout.app')
@section('title')
    @if ($downloadcategory->parent_id)
        <a href="{{ route('admin.download.index') }}">Download Categories</a> /
        @php
            $parents = \App\Helper::getParentRoute($parent_id, 'download_categories', 'downloadCategory');
        @endphp
        @foreach ($parents as $parent)
            <a href="{{ route('admin.downloadCategory.index', ['parent_id' => $parent->id]) }}">{{ $parent->title }}</a> /
        @endforeach
        <span>Sub Category</span> /
        <span>{{ $downloadcategory->title }}</span>/
        <span>Edit</span>
    @else
        <a href="{{ route('admin.downloadCategory.index') }}">Download Category</a> /
        <span>{{ $downloadcategory->title }}</span> /
        <span>Edit</span>
    @endif

@endsection
@section('content')
    <form action="{{ route('admin.downloadCategory.edit', ['category' => $downloadcategory->id]) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <label for="icon">Icon (16x16px or any 1:1 ratio) <span style="color: red;">*</span></label>
                        <input type="file" class="form-control dropify" id="icon" name="icon" accept="image/*"
                            data-default-file="{{ asset($downloadcategory->icon) }}">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="title">Title <span style="color: red;">*</span></label>
                    <input type="text" class="form-control" id="title" name="title"
                        value="{{ $downloadcategory->title }}" required>
                </div>
                <div class="d-flex">
                    <button type="submit" class="btn btn-success">
                        Update
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection
