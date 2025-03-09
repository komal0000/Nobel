@extends('admin.layout.app')
@section('title')
    @if ($speciality_id)
        <a href="{{ route('admin.speciality.index') }}">Specialities</a> /
        @php
            $parents = \App\Helpers\Helper::getSpecialityRoutes($speciality_id);
        @endphp
        @foreach ($parents as $parent)
            <a href="{{ route('admin.speciality.index', ['speciality_id' => $parent->id]) }}">{{ $parent->title }}</a> /
        @endforeach
        <span>Sub Specialties</span> /
        <a href="{{ route('admin.treatment.index', ['speciality_id' => $speciality_id]) }}">Treatments</a> /
        <span>{{ $treatment->title }}</span> /
        <a
            href="{{ route('admin.treatment.section.index', ['treatment_id' => $treatment->id, 'speciality_id' => $speciality_id]) }}">Sections</a>
        /
        <span>Add</span>
    @else
        <a href="{{ route('admin.treatment.index') }}">Treatments</a> /
        <span>{{ $treatment->title }}</span> /
        <a href="{{ route('admin.treatment.section.index', ['treatment_id' => $treatment->id]) }}">Sections</a> /
        <span>Add</span>
    @endif
@endsection
@section('content')
    <form action="{{ route('admin.treatment.section.add', ['treatment_id' => $treatment->id]) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-5">
                <div class="col-md-12 mb-3">
                    <label for="title">Title <span style="color: red;">*</span></label>
                    <input type="text" class="form-control" id="title" name="title">
                </div>
                <div class="col-md-12 mb-3">
                    <label for="style_type">Style Type <span style="color: red;">*</span></label>
                    <input type="text" class="form-control" id="style_type" name="style_type">
                </div>
            </div>
            <div class="col-md-7">
                <div class="col-md-12 mb-3">
                    <label for="description">Description <span style="color: red;">*</span></label>
                    <textarea class="form-control" id="description" name="description"></textarea>
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
