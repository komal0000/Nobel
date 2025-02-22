@extends('admin.layout.app')
@section('title')
    <a href="{{ route('admin.aliment.index') }}">Alignment</a> /
    <a href="{{route('admin.aliment.type.index',['aliment_id'=>$alimentType->aliment_id])}}">Section Types</a> /
    <a href="{{route('admin.aliment.type.section.index',['type_id'=>$alimentType->id])}}">Section</a> /
    <span>Edit</span>
@endsection
@section('content')
    <div class="p-4">
        <form action="{{route('admin.aliment.type.section.edit',['section_id'=>$section->id])}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <label for="image">Image</label>
                    <input type="file" name="image" id="image" class="form-control dropify" accept="image/*" data-default-file="{{ Storage::url($section->image) }}">
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ $section->title }}">
                        </div>
                        <div class="col-md-12 mb-4">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control">{{ $section->description }}</textarea>
                        </div>
                        <div class="col-md-4 mt-2">
                            <div class="form-check">
                                <label for="show_on_frontend">Show on Frontend</label>
                                <input type="hidden" name="show_on_frontend" value="0">
                                <input type="checkbox" name="show_on_frontend" id="show_on_frontend" class="form-check-input" value="1" {{ $section->show_on_frontend ? 'checked' : '' }}>
                            </div>
                        </div>
                        <div class="col-md-6 mt-2 d-flex align-items-end">
                            <button class="btn btn-primary btn-sm">
                                Edit
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
