@extends('admin.layout.app')
@section('title')
    <a href="{{ route('admin.service.index') }}">Services</a> /
    <span>Edit</span>
@endsection
@section('content')
    <form action="{{ route('admin.service.edit', ['service_id' => $service->id]) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="col-md-12 mb-2">
                    <label for="image">Image</label>
                    <input type="file" name="image" id="image" class="form-control dropify" accept="image/*"
                        data-default-file="{{ Storage::url($service->image) }}">
                </div>
                <div class="col-md-12 mb-2">
                    <label for="single_page_image">Single Page Image</label>
                    <input type="file" name="single_page_image" id="single_page_image" class="form-control dropify"
                        accept="image/*" data-default-file="{{ Storage::url($service->single_page_image) }}">
                </div>
                <div class="col-md-12 mb-2">
                    <label for="icon">Icon</label>
                    <input type="file" name="icon" id="icon" class="form-control dropify"
                        data-default-file="{{ Storage::url($service->icon) }}" accept="image/*">
                </div>
            </div>
            <div class="col-md-6">
                <div class="col-md-12 mb-2">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ $service->title }}"
                        required>
                </div>
                <div class="col-md-12 mb-2">
                    <label for="short_desc">Short Description</label>
                    <textarea name="short_desc" id="short_desc" class="form-control" required>{{ $service->short_desc }}</textarea>
                </div>
                <div class="col-md-12 d-flex justify-content-end">
                    <button class="btn btn-warning">
                        Update
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection
