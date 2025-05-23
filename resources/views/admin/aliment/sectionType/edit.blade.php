@extends('admin.layout.app')
@section('title')
    <a href="{{ route('admin.aliment.sectionType.index') }}">Ailment Section Type</a> /
    <span>Edit</span>
@endsection
@section('content')
    <form action="{{ route('admin.aliment.sectionType.edit', ['type_id' => $alimentType->id]) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <label for="icon">Icon 1:1 </label>
                <input type="file" name="icon" id="icon" class="form-control dropify" accept="image/*"
                    data-default-file="{{ asset($alimentType->icon) }}">
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" class="form-control"
                            value="{{ $alimentType->title }}">
                    </div>
                    {{-- <div class="col-md-12 mb-4">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control">{{ $alimentType->description }}</textarea>
                    </div> --}}
                    <div class="col-md-12 d-flex justify-content-end">
                        <button class="btn btn-success">
                            Update
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
