@extends('admin.layout.app')
@section('title')
    <a href="{{ route('admin.speciality.index') }}">Specialties</a> /
    <a href="{{ route('admin.speciality.gallery.index', ['speciality_id' => $specialityGallery->specialty_id]) }}">Gallery</a> /
    <span>Edit</span>
@endsection
@section('content')
    <form action="{{ route('admin.speciality.gallery.edit', ['gallery_id' => $specialityGallery->id]) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $specialityGallery->title }}" required>
            </div>
            <div class="col-md-8 mb-3">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description">{{ $specialityGallery->description }}</textarea>
            </div>
            <div class="col-md-4 mb-3">
                <label for="icon">Icon</label>
                <input type="file" class="form-control dropify" id="icon" name="icon" accept="image/*" data-default-file="{{ asset($specialityGallery->icon) }}">
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button type="submit" class="btn btn-primary">
                    Update
                </button>
            </div>
        </div>
    </form>
@endsection
