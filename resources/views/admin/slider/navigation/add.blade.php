@extends('admin.layout.app')
@section('title')
    <a href="{{ route('admin.slider.navigation.index') }}">Slider Navigation</a> /
    <span>Add</span>
@endsection
@section('content')
    <form action="{{ route('admin.slider.navigation.add') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-5">
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <label for="icon">Icon (16x16px or any 1:1 ratio) <span style="color: red;">*</span></label>
                        <input type="file" name="icon" id="icon" class="form-control dropify" accept="image/*"
                            required>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="col-md-12 mb-2">
                    <label for="title">Title <span style="color: red;">*</span></label>
                    <input type="text" name="title" id="title" class="form-control" required>
                </div>
                <div class="col-md-12 mb-2">
                    <label for="link">Link <span style="color: red;">*</span></label>
                    <input type="text" name="link" id="link" class="form-control" required>
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
