@extends('admin.layout.app')
@section('title')
    <a href="{{ route('admin.treatment.index') }}">Treatments</a> /
    <span> Add</span>
@endsection
@section('content')
    <form action="{{ route('admin.treatment.add') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title">
            </div>
            <div class="col-md-8 mb-3">
                <label for="short_description">Short Description</label>
                <textarea class="form-control" id="short_description" name="short_description"></textarea>
            </div>
            <div class="col-md-6 mb-3">
                <label for="icon">Icon</label>
                <input type="file" class="form-control dropify" id="icon" name="icon" accept="image/*">
            </div>
            <div class="col-md-6 mb-3">
                <label for="single_page_image">Single Page Image</label>
                <input type="file" class="form-control dropify" id="single_page_image" name="single_page_image"
                    accept="image/*">
            </div>


            <div class="col-md-12 d-flex align-items-end">
                <button type="submit" class="btn btn-primary">
                    Add
                </button>
            </div>
        </div>
    </form>
@endsection
