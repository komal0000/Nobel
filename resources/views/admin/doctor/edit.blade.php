@extends('admin.layout.app')
@section('title')
    <a href="{{ route('admin.doctor.index') }}">Doctors</a> /
    <span>Edit</span>
@endsection
@section('content')
    <form action="{{ route('admin.doctor.edit', ['doctor_id' => $doctor->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-5 mb-3">
                <label for="image">Image</label>
                <input type="file" name="image" id="image" class="form-control dropify"
                       data-default-file="{{ asset('storage/' . $doctor->image) }}" accept="image/*">
            </div>
            <div class="col-md-7 mb-3">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="title">Name <span style="color: red;">*</span></label>
                        <input type="text" name="title" id="title" class="form-control"
                               value="{{ $doctor->title }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="position">Position <span style="color: red;">*</span></label>
                        <input type="text" name="position" id="position" class="form-control"
                               value="{{ $doctor->position }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="specialty_id">Specialty <span style="color: red;">*</span></label>
                        <select name="specialty_id" id="specialty_id" class="form-control" required>
                            @foreach ($specialties as $specialty)
                                <option value="{{ $specialty->id }}"
                                    {{ $doctor->specialty_id == $specialty->id ? 'selected' : '' }}>
                                    {{ $specialty->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="location">Location <span style="color: red;">*</span></label>
                        <input type="text" name="location" id="location" class="form-control"
                               value="{{ $doctor->location }}" required>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mb-3">
                <label for="qualification">Qualifications</label>
                <div class="row">
                    @php
                        $qualifications = isset($doctor->qualification) ? json_decode($doctor->qualification, true) : [];
                    @endphp
                    <div class="col-md-6 mb-2">
                        <input type="text" name="qualification[0]" class="form-control"
                               value="{{ $qualifications[0] ?? '' }}" placeholder="Qualification 1">
                    </div>
                    <div class="col-md-6 mb-2">
                        <input type="text" name="qualification[1]" class="form-control"
                               value="{{ $qualifications[1] ?? '' }}" placeholder="Qualification 2">
                    </div>
                    <div class="col-md-6 mb-2">
                        <input type="text" name="qualification[2]" class="form-control"
                               value="{{ $qualifications[2] ?? '' }}" placeholder="Qualification 3">
                    </div>
                    <div class="col-md-6 mb-2">
                        <input type="text" name="qualification[3]" class="form-control"
                               value="{{ $qualifications[3] ?? '' }}" placeholder="Qualification 4">
                    </div>
                </div>
            </div>
            <div class="col-md-12 mb-3">
                <label for="short_description">Short Description</label>
                <textarea name="short_description" id="short_description" class="form-control" rows="3">{{ $doctor->short_description }}</textarea>
            </div>

            <div class="col-md-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>
    </form>
@endsection
