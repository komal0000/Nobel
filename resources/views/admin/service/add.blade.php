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
                        <label for="icon">Icon (16x16px or any 1:1 ratio) <span style="color: red;">*</span></label>
                        <input type="file" name="icon" id="icon" class="form-control dropify" accept="image/*"
                            required>
                    </div>
                    <div class="col-md-4 mb-2">
                        <label for="image">Image (960x480px or 1920x960px) <span style="color: red;">*</span></label>
                        <input type="file" name="image" id="image" class="form-control dropify" accept="image/*"
                            required>
                    </div>
                    <div class="col-md-4 mb-2">
                        <label for="single_page_image">Single Page Image (1920x480px)<span style="color: red;">*</span></label>
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
                    <label for="short_desc">Short Description (30-40 words) <span style="color: red;">*</span></label>
                    <textarea name="short_desc" id="short_desc" class="form-control" required></textarea>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <input type="hidden" name="has_package" value="0">
                        <input type="checkbox" name="has_package" id="has_package" value="1" class="form-check-input">
                        <label for="has_package">Has Package</label>
                    </div>
                    <div class="col-md-6 d-flex justify-content-end">
                        <button class="btn btn-primary">
                            Save
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
