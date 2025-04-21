@extends('admin.layout.app')
@section('title')
    @if ($parent_speciality_id)
        <a href="{{ route('admin.speciality.index') }}">Specialties</a> /
        @php
            $parents = \App\Helper::getSpecialityRoutes($parent_speciality_id);
        @endphp
        @foreach ($parents as $parent)
            <a href="{{ route('admin.speciality.index', ['parent_speciality_id' => $parent->id]) }}">{{ $parent->title }}</a>
            /
        @endforeach
        <span>Sub Specialties</span>/
        <a
            href="{{ route('admin.speciality.gallery.index', ['speciality_id' => $specialityGallery->specialty_id, 'parent_speciality_id' => $parent_speciality_id]) }}">Teams</a>
        /
        <span>Edit</span>
    @else
        <a href="{{ route('admin.speciality.index') }}">Specialties</a> /
        <span>{{ $speciality->title }}</span> /
        <a
            href="{{ route('admin.speciality.gallery.index', ['speciality_id' => $specialityGallery->specialty_id]) }}">Teams</a>
        /
        <span>Edit</span>
    @endif
@endsection
@section('content')
    <form action="{{ route('admin.speciality.gallery.edit', ['gallery_id' => $specialityGallery->id]) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="icon">Icon</label>
                <input type="file" class="form-control dropify" id="icon" name="icon" accept="image/*"
                    data-default-file="{{ Storage::url($specialityGallery->icon) }}">
            </div>
            <div class="col-md-6">
                <div class="col-md-12 mb-2">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title"
                        value="{{ $specialityGallery->title }}" required>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description">{{ $specialityGallery->description }}</textarea>
                </div>
                <div class="col-md-12 d-flex justify-content-end">
                    <button type="submit" class="btn btn-success">
                        Update
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection
