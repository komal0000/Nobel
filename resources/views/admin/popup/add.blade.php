@extends('admin.layout.app')
@section('title')
    <a href="{{ route('admin.popup.index') }}">Popups</a> /
    <span>Add</span>
@endsection
@section('content')
    <form action="{{ route('admin.popup.add') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <label for="image">Image<span style="color: red;">*</span></label>
                        <input type="file" name="image" id="image" class="form-control dropify" accept="image/*"
                            required>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="col-md-12 mb-2">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control">
                </div>
                <div class="col-md-12 mb-2">
                    <label for="link">Link</label>
                    <input type="text" name="link" id="link" class="form-control">
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
