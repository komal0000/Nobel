@extends('admin.layout.app')
@section('title')
    @if ($parent_speciality_id == null)
        <a href="{{ route('admin.speciality.index') }}">Specialties</a> /
        <span>Add</span>
    @else
        <a href="{{ route('admin.speciality.index') }}">Specialties</a> /
        @php
            $parents = \App\Helper::getSpecialityRoutes($parent_speciality_id);
        @endphp
        @foreach ($parents as $parent)
            <a href="{{ route('admin.speciality.index', ['parent_speciality_id' => $parent->id]) }}">{{ $parent->title }}</a> /
        @endforeach
        <span>Add</span>
    @endif
@endsection
@section('content')
    <form action="{{ route('admin.speciality.add', ['parent_speciality_id' => $parent_speciality_id]) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        <label for="icon">Icon <span style="color: red;">*</span></label>
                        <input type="file" class="form-control dropify" id="icon" name="icon" accept="image/*"
                            required>
                    </div>
                    <div class="col-md-6">
                        <label for="single_page_image">Single Page Image <span style="color: red;">*</span> </label>
                        <input type="file" class="form-control dropify" id="single_page_image" name="single_page_image"
                            accept="image/*" required>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="title">Title <span style="color: red;">*</span></label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
                <div class="mb-3">
                    <label for="short_description">Short Description <span style="color: red;">*</span></label>
                    <textarea class="form-control" id="short_description" name="short_description" required></textarea>
                </div>
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-success">
                            Save
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
