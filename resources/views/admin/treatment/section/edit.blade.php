@extends('admin.layout.app')
@section('title')
    @if ($speciality_id)
        <a href="{{ route('admin.speciality.index') }}">Specialities</a> /
        @php
            $parents = \App\Helper::getSpecialityRoutes($speciality_id);
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
        <span>{{ $treatmentSection->title }}</span> /
        <span>Edit</span>
    @else
        <a href="{{ route('admin.treatment.index') }}">Treatments</a> /
        <span>{{ $treatment->title }}</span> /
        <a href="{{ route('admin.treatment.section.index', ['treatment_id' => $treatment->id]) }}">Sections</a> /
        <span>{{ $treatmentSection->title }}</span> /
        <span>Edit</span>
    @endif
@endsection
@section('content')
    <form action="{{ route('admin.treatment.section.edit', ['section_id' => $treatmentSection->id]) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-5">
                <div class="col-md-12 mb-3">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title"
                        value="{{ $treatmentSection->title }}">
                </div>
                <div class="col-md-12 mb-3">
                    <label for="style_type">Style Type <span style="color: red;">*</span></label>
                    <select class="form-control" id="style_type" name="style_type">
                        <option value="1" {{ $treatmentSection->style_type == 1 ? 'selected' : '' }}>Type 1</option>
                        <option value="2" {{ $treatmentSection->style_type == 2 ? 'selected' : '' }}>Type 2</option>
                        <option value="3" {{ $treatmentSection->style_type == 3 ? 'selected' : '' }}>Type 3</option>
                    </select>
                </div>
            </div>
            <div class="col-md-7">
                <div class="col-md-12 mb-3">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description">{{ $treatmentSection->description }}</textarea>
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
