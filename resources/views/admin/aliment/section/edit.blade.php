@extends('admin.layout.app')
@section('title')
    @if ($speciality->id)
        <a href="{{ route('admin.speciality.index') }}">Specialities</a> /
        <span> {{ $speciality->title }}</span> /
        <a href="{{ route('admin.aliment.index', ['speciality_id' => $speciality->id]) }}">Aliment</a> /
        <span>{{ $aliment->title }}</span> /
        <a
            href="{{ route('admin.aliment.section.index', ['aliment_id' => $aliment->id, 'speciality_id' => $speciality->id]) }}">Sections</a>/
        <span>{{ $section->title }}</span> /
        <span>Edit</span>
    @else
        <a href="{{ route('admin.aliment.index') }}">Aliment</a> /
        <a href="{{ route('admin.aliment.section.index', ['aliment_id' => $aliment->id]) }}">Section</a> /
        <span>Edit</span>
    @endif
@endsection
@section('content')
    <form action="{{ route('admin.aliment.section.edit', ['section_id' => $section->id]) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="image">Image</label>
                <input type="file" name="image" id="image" class="form-control dropify" accept="image/*"
                    data-default-file="{{ Storage::url($section->image) }}">
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" class="form-control"
                            value="{{ $section->title }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="type">Section Type</label>
                        <select name="section_type_id" id="section_type_id" class="form-control">
                            @foreach ($alimentSectionTypes as $type)
                                <option value="{{ $type->id }}" {{ $type->id == $section->aliment_section_type_id ? 'selected' : '' }}>
                                    {{ $type->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control">{{ $section->description }}</textarea>
                    </div>
                    <div class="col-md-4 d-flex align-items-center">
                        <div class="form-check">
                            <input type="hidden" name="show_on_frontend" value="0">
                            <input type="checkbox" name="show_on_frontend" id="show_on_frontend" class="form-check-input"
                                value="1" {{ $section->show_on_frontend ? 'checked' : '' }}>
                            <label class="form-check-label" for="show_on_frontend">Show on Frontend</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-success">
                            Update
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
