@extends('admin.layout.app')
@section('title')
    <a href="{{ route('admin.popup.index') }}">Popups</a> /
    <span>Edit</span>
@endsection
@section('content')
    <form action="{{ route('admin.popup.edit', $popup->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <label for="image">Image<span style="color: red;">*</span></label>
                        <input type="file" name="image" id="image" class="form-control dropify"
                            data-default-file="{{ Storage::url($popup->image) }}" accept="image/*">
                        <small class="text-muted">Leave empty to keep current image</small>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="col-md-12 mb-2">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ $popup->title }}" required>
                </div>
                <div class="col-md-12 mb-2">
                    <label for="link">Link</label>
                    <input type="text" name="link" id="link" class="form-control" value="{{ $popup->link }}">
                </div>
                <div class="col-md-12 d-flex justify-content-end">
                    <button class="btn btn-primary">
                        Update
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection
