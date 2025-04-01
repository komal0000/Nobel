@extends('admin.layout.app')
@section('title')
    <a href="{{ route('admin.service.index') }}">Services</a> /
    <span>Add</span>
@endsection
@section('content')
    <form action="{{ route('admin.service.add') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-7">
                <div class="row">
                    <div class="col-md-4 mb-2">
                        <label for="icon">Icon 1:1 <span style="color: red;">*</span></label>
                        <input type="file" name="icon" id="icon" class="form-control dropify" accept="image/*"
                            required>
                    </div>
                    <div class="col-md-4 mb-2">
                        <label for="image">Image 4:2 <span style="color: red;">*</span></label>
                        <input type="file" name="image" id="image" class="form-control dropify" accept="image/*"
                            required>
                    </div>
                    <div class="col-md-4 mb-2">
                        <label for="single_page_image">Single Page Image 4:1<span style="color: red;">*</span></label>
                        <input type="file" name="single_page_image" id="single_page_image" class="form-control dropify"
                            accept="image/*" required>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="col-md-12 mb-2">
                    <label for="title">Title <span style="color: red;">*</span></label>
                    <input type="text" name="title" id="title" class="form-control" required>
                </div>
                <div class="col-md-12 mb-2">
                    <label for="short_desc">Short Description <span style="color: red;">*</span></label>
                    <textarea name="short_desc" id="short_desc" class="form-control" required></textarea>
                </div>
                <div class="col-md-12 d-flex justify-content-end">
                    <button class="btn btn-primary">
                        Save
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection
