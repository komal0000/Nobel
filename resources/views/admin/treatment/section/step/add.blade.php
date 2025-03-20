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
        <span>{{ $section->title }}</span> /
        <a
            href="{{ route('admin.treatment.section.step.index', ['section_id' => $section->id, 'speciality_id' => $speciality_id]) }}">Steps</a>
        /
        <span>Add</span>
    @else
        <a href="{{ route('admin.treatment.index') }}">Treatments</a> /
        <span>{{ $treatment->title }}</span> /
        <a href="{{ route('admin.treatment.section.index', ['treatment_id' => $section->treatment_id]) }}">Sections</a> /
        <span>{{ $section->title }}</span> /
        <a href="{{ route('admin.treatment.section.step.index', ['section_id' => $section->id]) }}">Steps</a> /
        <span>Add</span>
    @endif
@endsection

@section('content')
    <form action="{{ route('admin.treatment.section.step.add', ['section_id' => $section->id]) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="col-md-12">
                    <label for="icon">Icon <span style="color: red;">*</span></label>
                    <input type="file" class="form-control dropify" id="icon" name="icon" accept="image/*">
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <label for="title">Title <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" id="title" name="title">
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="short_description">Short Description <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" id="short_description" name="short_description">
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="long_description">Long Description <span style="color: red;">*</span></label>
                        <textarea class="form-control" id="long_description" name="long_description"></textarea>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-3 d-flex justify-content-end">
                <button type="submit" class="btn btn-success">
                    Save
                </button>
            </div>
        </div>
    </form>
@endsection
