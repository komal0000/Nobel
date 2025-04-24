@extends('admin.layout.app')
@section('title')
    <a href="{{ route('admin.service.index') }}">Services</a> /
    <span>{{$service->title}}</span> /
    <a href="{{ route('admin.service.benefit.index', ['service_id' => $benefit->service_id]) }}">Benefits</a> /
    <span>Edit</span>
@endsection
@section('content')
    <form action="{{ route('admin.service.benefit.edit', ['benefit_id' => $benefit->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="col-md-12 mb-3">
                    <label for="icon">Icon </label>
                    <input type="file" name="icon" id="icon" class="form-control dropify"
                        data-default-file="{{ $benefit->icon ? asset($benefit->icon) : '' }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="col-md-12 mb-3">
                    <label for="title">Title <span style="color: red;">*</span></label>
                    <input type="text" name="title" id="title" class="form-control" required
                        value="{{ $benefit->title }}">
                </div>
                <div class="col-md-12 mb-3">
                    <label for="short_desc">Short Description <span style="color: red;">*</span></label>
                    <textarea name="short_desc" id="short_desc" class="form-control" rows="5" required>{{ $benefit->short_desc }}</textarea>
                </div>
            </div>

            <div class="col-md-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>
    </form>
@endsection
