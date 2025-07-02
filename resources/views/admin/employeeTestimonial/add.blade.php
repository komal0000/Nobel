@extends('admin.layout.app')
@section('title')
    <a href="{{ route('admin.employeeTestimonial.index') }}">Employee Testimonials</a> /
    <span>Add</span>
@endsection
@section('content')
    <form action="{{ route('admin.employeeTestimonial.add') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="col-md-12 mb-3">
                    <label for="image">Image (500x500px or 1000x1000px) <span style="color: red;">*</span></label>
                    <input type="file" class="form-control dropify" id="image" name="image" accept="image/*" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="col-md-12 mb-2">
                    <label for="title">Title <span style="color: red;">*</span></label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="short_description">Short Description (25-30 words) <span style="color: red;">*</span></label>
                    <textarea class="form-control" id="short_description" name="short_description" required></textarea>
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
