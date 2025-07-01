@extends('admin.layout.app')
@section('title')
    @if ($speciality_id)
        <a href="{{ route('admin.speciality.index') }}">Specialties</a> /
        @php
            $parents = \App\Helper::getSpecialityRoutes($speciality_id);
        @endphp
        @foreach ($parents as $parent)
            <a href="{{ route('admin.speciality.index', ['speciality_id' => $parent->id]) }}">{{ $parent->title }}</a> /
        @endforeach
        <a href="{{ route('admin.treatment.index', ['speciality_id' => $speciality_id]) }}">Treatments</a> /
        <span>Add</span>
    @else
        <a href="{{ route('admin.treatment.index') }}">Treatments</a> /
        <span>Add</span>
    @endif
@endsection
@section('content')
    <form action="{{ route('admin.treatment.add', ['speciality_id' => $speciality_id]) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        <div class="row">
            <input type="hidden" name="specialty_id" id="specialty_id" value="{{$speciality_id}}">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="icon">Image (500x500px or 1000x1000px)<span style="color: red;">*</span></label>
                        <input type="file" class="form-control dropify" id="icon" name="icon" accept="image/*">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="single_page_image">Single Page Image (1920x480px) <span style="color: red;">*</span></label>
                        <input type="file" class="form-control dropify" id="single_page_image" name="single_page_image"
                            accept="image/*">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="col-md-12 mb-2">
                    <label for="title">Title <span style="color: red;">*</span></label>
                    <input type="text" class="form-control" id="title" name="title">
                </div>
                <div class="col-md-12 mb-3">
                    <label for="short_description">Short Description <span style="color: red;">*</span></label>
                    <textarea class="form-control" id="short_description" name="short_description"></textarea>
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
