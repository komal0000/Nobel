@extends('admin.layout.app')
@section('title')
    @if ($speciality_id)
        <a href="{{ route('admin.speciality.index') }}">Specialities</a> /
        <span>{{ $speciality->title }}</span> /
        <a href="{{ route('admin.treatment.index', ['speciality_id' => $speciality_id]) }}">Treatments</a> /
        <span>{{ $treatment->title }}</span> /
        <a href="{{ route('admin.treatment.section.index', ['treatment_id'=>$treatment->id, 'speciality_id' => $speciality_id]) }}">Sections</a> /
        <span>Add</span>
    @else
        <a href="{{ route('admin.treatment.index') }}">Treatments</a> /
        <span>{{ $treatment->title }}</span> /
        <a href="{{ route('admin.treatment.section.index') }}"></a> /
        <span>Add</span>
    @endif
    <a href="{{ route('admin.treatment.index') }}">Treatments</a> /
    <span>{{ $treatment->title }}</span> /
    <a href="{{ route('admin.treatment.section.index', ['treatment_id' => $treatmentSection->treatment_id]) }}">Sections</a> /
    <span> Edit</span>
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
                    <label for="style_type">Style Type</label>
                    <input type="text" class="form-control" id="style_type" name="style_type"
                        value="{{ $treatmentSection->style_type }}">
                </div>
            </div>
            <div class="col-md-7">
                <div class="col-md-12 mb-3">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description">{{ $treatmentSection->description }}</textarea>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-success">
                        Update
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection
