@extends('admin.layout.app')
@section('title')
    <a href="{{ route('admin.gallery.type.index') }}">Gallery Types</a> /
    <span>{{ $type->title }}</span> /
    <span>Edit</span>
@endsection
@section('content')
    <form action="{{ route('admin.gallery.edit', ['gallery_id' => $gallery->id]) }}" method="POST" class="mb-4" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-4">
                <div class="col-md-12">
                    <label for="image">Image (Any ratio around same height)<span style="color: red;">*</span></label>
                    <input type="file" name="image" id="image" class="form-control dropify" data-default-file="{{ asset($gallery->image) }}">
                </div>
            </div>
            <div class="col-md-8">
                <div class="col-md-12">
                    <label for="title">Title </label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ $gallery->title }}">
                </div>
                <div class="col-md-12">
                    <label for="description">Description (less than 40 words)</label>
                    <textarea name="description" id="description" class="form-control">{{ $gallery->description }}</textarea>
                </div>
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button class="btn btn-warning">
                    Update
                </button>
            </div>
        </div>
    </form>
@endsection
