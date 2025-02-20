@extends('admin.layout.app')
@section('content')
<div class="p-2 shadow">
    <form action="{{ route('admin.speciality.add') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="icon">Icon</label>
            <input type="file" class="form-control" id="icon" name="icon" required>
        </div>
        <div class="form-group">
            <label for="short_description">Short Description</label>
            <textarea class="form-control" id="short_description" name="short_description" rows="3" required></textarea>
        </div>
        <div class="form-group">
            <label for="single_page_image">Single Page Image</label>
            <input type="file" class="form-control" id="single_page_image" name="single_page_image" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
