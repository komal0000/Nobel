@extends('admin.layout.app')
@section('title')
    <a href="{{ route('admin.treatment.index') }}">Treatments</a> /
    <span> Edit</span>
@endsection
@section('content')
    <form action="{{ route('admin.treatment.edit', ['treatment_id' => $treatment->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="icon">Icon</label>
                        <input type="file" class="form-control dropify" id="icon" name="icon" accept="image/*" data-default-file="{{ Storage::url($treatment->icon) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="single_page_image">Single Page Image</label>
                        <input type="file" class="form-control dropify" id="single_page_image" name="single_page_image" accept="image/*" data-default-file="{{ Storage::url($treatment->single_page_image) }}">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="col-md-12 mb-2">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $treatment->title }}">
                </div>
                <div class="col-md-12 mb-3">
                    <label for="short_description">Short Description</label>
                    <textarea class="form-control" id="short_description" name="short_description">{{ $treatment->short_description }}</textarea>
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-success">
                        Edit
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection
