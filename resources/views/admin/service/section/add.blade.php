@extends('admin.layout.app')
@section('title')
    <a href="{{ route('admin.service.index') }}">Services</a> /
    <span>{{$service->title}}</span> /
    <a href="{{ route('admin.service.section.index', ['service_id' => $service->id]) }}">Sections</a> /
    <span>Add</span>
@section('content')
    <form action="{{ route('admin.service.section.add', ['service_id' => $service->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="col-md-12 mb-3">
                    <label for="image">Image</label>
                    <input type="file" name="image" id="image" class="form-control dropify">
                </div>
                <div class="col-md-12 mb-3">
                    <label for="image_placement">Image Placement</label>
                    <select name="image_placement" id="image_placement" class="form-control">
                        <option value="left">Left</option>
                        <option value="right">Right</option>
                        <option value="center">Center</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="col-md-12 mb-3">
                    <label for="title">Title <span style="color: red;">*</span></label>
                    <input type="text" name="title" id="title" class="form-control" required>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="short_desc1">Description 1 <span style="color: red;">*</span></label>
                    <textarea name="short_desc1" id="short_desc1" class="form-control" rows="3" required></textarea>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="short_desc2">Description 2</label>
                    <textarea name="short_desc2" id="short_desc2" class="form-control" rows="3"></textarea>
                </div>
            </div>

            <div class="col-md-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
@endsection
