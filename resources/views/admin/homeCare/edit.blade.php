@extends('admin.layout.app')
@section('title')
    <a href="{{ route('admin.homeCare.index') }}">Home Care</a> /
    <span>Edit</span>
@endsection
@section('content')
    <form action="{{ route('admin.homeCare.edit', $HomeCare->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="col-md-12 mb-3">
                    <label for="image">Image <span style="color: red;">*</span></label>
                    <input type="file" class="form-control dropify" id="image" name="image" accept="image/*">
                    <img src="{{ Storage::url($HomeCare->image) }}" alt="Current Image" width="100">
                </div>
            </div>
            <div class="col-md-6">
                <div class="col-md-12 mb-2">
                    <label for="title">Title <span style="color: red;">*</span></label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $HomeCare->title }}" required>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="link">Link<span style="color: red;">*</span></label>
                    <input type="text" name="link" id="link" class="form-control" value="{{ $HomeCare->link }}">
                </div>
                <div class="col-md-12 d-flex justify-content-end">
                    <button type="submit" class="btn btn-success">
                        Update
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection
