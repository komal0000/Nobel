@extends('admin.layout.app')
@section('title')
    <a href="{{ route('admin.aliment.index') }}">Aliment</a> /
    <a href="{{ route('admin.aliment.section.index', ['aliment_id' => $aliment_id]) }}">Section</a> /
    <span>Edit</span>
@endsection
@section('content')
    <form action="{{ route('admin.aliment.section.edit', ['section_id' => $section->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="image">Image</label>
                <input type="file" name="image" id="image" class="form-control dropify" accept="image/*"
                    data-default-file="{{ Storage::url($section->image) }}">
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" class="form-control"
                            value="{{ $section->title }}">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control">{{ $section->description }}</textarea>
                    </div>
                    <div class="col-md-4 d-flex align-items-center">
                        <div class="form-check">
                            <input type="hidden" name="show_on_frontend" value="0">
                            <input type="checkbox" name="show_on_frontend" id="show_on_frontend" class="form-check-input"
                                value="1" {{ $section->show_on_frontend ? 'checked' : '' }}>
                            <label class="form-check-label" for="show_on_frontend">Show on Frontend</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-success">
                            Update
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
