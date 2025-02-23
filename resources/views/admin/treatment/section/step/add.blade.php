@extends('admin.layout.app')
@section('title')
    <a href="{{ route('admin.treatment.index') }}">Treatments</a> /
    <a href="{{ route('admin.treatment.section.index', ['treatment_id' => $section->treatment_id]) }}">Sections</a> /
    <a href="{{ route('admin.treatment.section.step.index', ['section_id' => $section_id]) }}">Steps</a> /
    <span>Add</span>
@endsection

@section('content')
    <form action="{{ route('admin.treatment.section.step.add', ['section_id' => $section_id]) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="col-md-12">
                    <label for="icon">Icon</label>
                    <input type="file" class="form-control dropify" id="icon" name="icon" accept="image/*">
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title">
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="short_description">Short Description</label>
                        <input type="text" class="form-control" id="short_description" name="short_description">
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="long_description">Long Description</label>
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
