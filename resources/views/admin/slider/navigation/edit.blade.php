@extends('admin.layout.app')
@section('title')
    <a href="{{ route('admin.slider.navigation.index') }}">Slider Navigation</a> /
    <span>Edit</span>
@endsection
@section('content')
    <form action="{{ route('admin.slider.navigation.edit', ['navigation_id' => $navigation->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-7">
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <label for="icon">Icon <span style="color: red;">*</span></label>
                        <input type="file" name="icon" id="icon" class="form-control dropify" accept="image/*"
                            data-default-file="{{ asset($navigation->icon) }}">
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="col-md-12 mb-2">
                    <label for="title">Title <span style="color: red;">*</span></label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ $navigation->title }}" required>
                </div>
                <div class="col-md-12 mb-2">
                    <label for="link">Link <span style="color: red;">*</span></label>
                    <input type="text" name="link" id="link" class="form-control" value="{{ $navigation->link }}" required>
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
