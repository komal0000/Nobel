@extends('admin.layout.app')
@section('title')
    @if ($parent_speciality_id == null)
        <a href="{{ route('admin.speciality.index') }}">Speciality</a>
        <span>Specialties</span>
    @else
        <a href="{{ route('admin.speciality.index') }}">Speciality</a> /
        <a href="{{ route('admin.speciality.index', ['parent_speciality_id' => $parent_speciality_id]) }}">Sub Speciality</a> /
        <span>Add</span>
    @endif
@endsection
@section('content')
    <form action="{{ route('admin.speciality.add', ['parent_speciality_id' => $parent_speciality_id]) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        <label for="icon">Icon</label>
                        <input type="file" class="form-control dropify" id="icon" name="icon" accept="image/*">
                    </div>
                    <div class="col-md-6">
                        <label for="single_page_image">Single Page Image</label>
                        <input type="file" class="form-control dropify" id="single_page_image" name="single_page_image"
                            accept="image/*">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
                <div class="mb-3">
                    <label for="short_description">Short Description</label>
                    <textarea class="form-control" id="short_description" name="short_description"></textarea>
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
