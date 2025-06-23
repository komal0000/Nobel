@extends('admin.layout.app')
@section('title')
    <a href="{{ route('admin.setting.nationalImage.index') }}">National Image</a> /
    <span>Add</span>
@endsection
@section('content')
    <form action="{{ route('admin.setting.nationalImage.add') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="desktop_image">Desktop Image 4:1 <span style="color: red;">*</span></label>
                        <input type="file" class="form-control dropify" id="desktop_image" name="desktop_image"
                            accept="image/*" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="mobile_image">Mobile Image 4:3 <span style="color: red;">*</span></label>
                        <input type="file" class="form-control dropify" id="mobile_image" name="mobile_image"
                            accept="image/*" required>
                    </div>
                </div>
            </div>
            <div class="col-md-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-success">
                    Save
                </button>
            </div>
        </div>
    </form>
@endsection
