@extends('admin.layout.app')
@section('title')
    <a href="{{ route('admin.video.type.index') }}">Video Types</a> /
    <span>{{ $videoType->title }}</span> /
    <a href="{{ route('admin.video.index', ['type_id' => $videoType->id]) }}">Videos</a> /
    <span>Edit</span>
@endsection
@section('content')
    <form action="{{ route('admin.video.edit', ['video_id' => $video->id]) }}" method="POST">
        @csrf
        <div class="row">
            <div class="mb-2 col-md-6 ">
                <label for="video_link">Video Link <span style="color: red;">*</span></label>
                <input type="text" name="video_link" id="video_link" class="form-control" value="{{ $video->video_link }}">
            </div>
            <div class="mb-2 col-md-6 ">
                <label for="title">Title <span style="color: red;">*</span></label>
                <input type="text" name="title" id="title" class="form-control" value="{{ $video->title }}">
            </div>
            <div class="mb-2 col-md-12">
                <label for="extra_data"></label>
                <textarea name="extra_data" id="extra_data" class="form-control">{{ $video->extra_data }}</textarea>
            </div>
            <div class="col-md-12">
                <button class="btn btn-sm btn-warning">
                    Update
                </button>
            </div>
        </div>
    </form>
@endsection
