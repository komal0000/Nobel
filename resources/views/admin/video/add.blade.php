@extends('admin.layout.app')
@section('title')
    <a href="{{ route('admin.video.type.index') }}">Video Types</a> /
    <span>{{ $videoType->title }}</span> /
    <a href="{{route('admin.video.index',['type_id'=>$videoType->id])}}">Videos</a> /
    <span>Add</span>
@endsection
@section('content')
    <form action="{{ route('admin.video.add', ['type_id'=>$videoType->id]) }}"  method="POST">
        @csrf
        <div class="row">
            <div class="mb-2 col-md-4 ">
                <label for="title">Title <span style="color: red;">*</span></label>
                <input type="text" name="title" id="title" class="form-control">
            </div>
            <div class="mb-2 col-md-8 ">
                <label for="video_link">Video Link <span style="color: red;">*</span></label>
                <input type="text" name="video_link" id="video_link" class="form-control">
            </div>
            <div class="mb-2 col-md-12">
                <label for="extra_data">Extra Data</label>
                <textarea name="extra_data" id="extra_data" class="form-control"></textarea>
            </div>
            <div class="col-md-12 d-flex justify-content-end">
                <button class="btn btn-primary">
                    Save
                </button>
            </div>
        </div>
    </form>
@endsection
