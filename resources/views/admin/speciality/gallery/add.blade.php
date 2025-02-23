@extends('admin.layout.app')
@section('title')
    <a href="{{ route('admin.speciality.index') }}">Specialties</a> /
    <a href="{{ route('admin.speciality.gallery.index', ['speciality_id' => $speciality_id]) }}">Gallery</a> /
    <span>Add</span>
@endsection
@section('content')
    <form action="{{ route('admin.speciality.gallery.add', ['speciality_id' => $speciality_id]) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="icon">Icon</label>
                <input type="file" class="form-control dropify" id="icon" name="icon" accept="image/*">
            </div>
            <div class="col-md-6">
                <div class="col-md-12 mb-2">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description"></textarea>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">
                        Add
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection
