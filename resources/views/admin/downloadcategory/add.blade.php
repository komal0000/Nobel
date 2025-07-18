@extends('admin.layout.app')
@section('title')
    @if ($parent_id)
        <a href="{{ route('admin.downloadCategory.index') }}">Download Categories</a> /
        @php
           $parents = \App\Helper::getParentRoute($parent_id, 'download_categories', 'downloadCategory');
        @endphp
        @foreach ($parents as $parent)
            <a href="{{ route('admin.downloadCategory.index', ['parent_id' => $parent->id]) }}">{{ $parent->title }}</a> /
        @endforeach
        <span>Sub Category</span> /
        <span>Add</span>
    @else
        <a href="{{ route('admin.downloadCategory.index') }}">Download Categories</a> /
        <span>Add</span>
    @endif
@endsection
@section('content')
    <form action="{{ route('admin.downloadCategory.add',['parent_id'=>$parent_id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <label for="icon">Icon (16x16px or any 1:1 ratio)</label>
                        <input type="file" class="form-control dropify" id="icon" name="icon" accept="image/*">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="title">Title <span style="color: red;">*</span></label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
                <div class="d-flex">
                    <button type="submit" class="btn btn-success">
                        Save
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection
