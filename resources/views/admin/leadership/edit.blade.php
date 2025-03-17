@extends('admin.layout.app')
@section('title')
    <a href="{{ route('admin.leadership.index') }}">Leaderships</a> /
    <span>Edit</span>
@endsection
@section('content')
    <form action="{{ route('admin.leadership.edit', $leadership->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="col-md-12 mb-3">
                    <label for="image">Image <span style="color: red;">*</span></label>
                    <input type="file" class="form-control dropify" id="image" name="image" data-default-file="{{asset($leadership->image)}}" accept="image/*">
                </div>
            </div>
            <div class="col-md-6">
                <div class="col-md-6 mb-2">
                    <label for="title">Title <span style="color: red;">*</span></label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $leadership->title }}">
                </div>
                <div class="col-md-6 mb-2">
                    <label for="position">Position <span style="color: red;">*</span> </label>
                    <input type="text" name="position" id="position" class="form-control" value="{{ $leadership->position }}">
                </div>
                <div class="col-md-12 mb-3">
                    <label for="description">Description <span style="color: red;">*</span></label>
                    <textarea class="form-control" id="description" name="description">{{ $leadership->description }}</textarea>
                </div>

                <div class="col-md-12 d-flex justify-content-end">
                    <button type="submit" class="btn btn-success">
                        Save
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection
