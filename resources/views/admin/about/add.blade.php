@extends('admin.layout.app')
@section('title')
    <a href="{{ route('admin.about.index') }}">About Us</a> /
    <span>Add</span>
@endsection
@section('content')
    <form action="{{ route('admin.about.add') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-4">
                <div class="col-md-12 mb-3">
                    <label for="image">Image (960x480px or 1920x960px) <span style="color: red;">*</span></label>
                    <input type="file" class="form-control dropify" id="image" name="image" accept="image/*"
                        required>
                </div>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <label for="title">Title <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="description">Description (~80 words) <span style="color: red;">*</span></label>
                    <textarea class="form-control summernote" id="description" name="description" rows="5" required></textarea>
                </div>

                <div class="col-md-12 d-flex justify-content-end">
                    <button type="submit" class="btn btn-success">
                        Save
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection
