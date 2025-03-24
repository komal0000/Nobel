@extends('admin.layout.app')
@section('title')
    <a href="{{ route('admin.gallery.type.index') }}">Gallery Types</a> /
    <a href="{{ route('admin.gallery.index',['type_id'=>$type->id]) }}">{{$type->title}}</a> /
    <span>Add</span>
@endsection
@section('content')
    <form action="{{ route('admin.gallery.add', ['type_id' => $type->id]) }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-4">
                <div class="col-md-12 mb-2">
                    <label for="image">Image <span style="color: red;">*</span></label>
                    <input type="file" name="image" id="image" class="form-control dropify" accept="image/*"
                        required>
                </div>
            </div>
            <div class="col-md-8">
                <div class="col-md-12 mb-2">
                    <label for="title">Title </label>
                    <input type="text" name="title" id="title" class="form-control">
                </div>
                <div class="col-md-12 mb-2">
                    <label for="description">Description </label>
                    <textarea name="description" id="description" class="form-control"></textarea>
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button class="btn btn-primary">
                        Save
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection
