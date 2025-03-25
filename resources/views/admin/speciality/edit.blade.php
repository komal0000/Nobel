@extends('admin.layout.app')
@section('title')
    @if ($parent_speciality_id)
        <a href="{{ route('admin.speciality.index') }}">Specialties</a> /
        @php
            $parents = \App\Helper::getSpecialityRoutes($speciality->parent_speciality_id);
        @endphp
        @foreach ($parents as $parent)
            <a href="{{ route('admin.speciality.index', ['parent_speciality_id' => $parent->id]) }}">{{ $parent->title }}</a> /
        @endforeach
        <span>Edit</span>
    @else
        <a href="{{ route('admin.speciality.index') }}">Specialties</a> /
        {{$speciality->title}} /
        <span>Edit</span>
    @endif
@endsection
@section('content')
    <form action="{{ route('admin.speciality.edit', ['speciality_id' => $speciality->id]) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        <label for="icon">Icon</label>
                        <input type="file" class="form-control dropify" id="icon" name="icon" accept="image/*"
                            data-default-file="{{ Storage::url($speciality->icon) }}">
                    </div>
                    <div class="col-md-6">
                        <label for="single_page_image">Single Page Image</label>
                        <input type="file" class="form-control dropify" id="single_page_image" name="single_page_image"
                            accept="image/*" data-default-file="{{ Storage::url($speciality->single_page_image) }}">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title"
                        value="{{ $speciality->title }}" required>
                </div>
                <div class="mb-3">
                    <label for="short_description">Short Description</label>
                    <textarea class="form-control" id="short_description" name="short_description">{{ $speciality->short_description }}</textarea>
                </div>
                <div class="row">
                    <div class="d-flex justify-content-end ">
                        <button type="submit" class="btn btn-success">
                            Update
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
