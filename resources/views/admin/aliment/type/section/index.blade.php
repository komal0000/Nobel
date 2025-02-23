@extends('admin.layout.app')
@section('title')
    <a href="{{ route('admin.aliment.index') }}">Alignment</a> /
    <a href="{{ route('admin.aliment.type.index', ['aliment_id' => $alimentType->aliment_id]) }}">Section Types</a> /
    <a href="{{ route('admin.aliment.type.section.index', ['type_id' => $alimentType->id]) }}">Section Info</a>
@endsection

@section('content')
    <div class="p-4">
        <form action="{{ route('admin.aliment.type.section.index', ['type_id' => $type_id]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div class="row">
                @if ($section)
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
                                    <input type="checkbox" name="show_on_frontend" id="show_on_frontend"
                                        class="form-check-input" value="1"
                                        {{ $section->show_on_frontend ? 'checked' : '' }}>
                                    <label class="form-check-label" for="show_on_frontend">Show on Frontend</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    Update
                                </button>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-md-4 mb-3">
                        <label for="image">Image</label>
                        <input type="file" name="image" id="image" class="form-control dropify" accept="image/*">
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" class="form-control">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" class="form-control"></textarea>
                            </div>
                            <div class="col-md-4 d-flex align-items-center">
                                <div class="form-check">
                                    <input type="hidden" name="show_on_frontend" value="0">
                                    <input type="checkbox" name="show_on_frontend" id="show_on_frontend"
                                        class="form-check-input" value="1">
                                    <label class="form-check-label" for="show_on_frontend">Show on Frontend</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    Update
                                </button>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </form>
    </div>
@endsection
