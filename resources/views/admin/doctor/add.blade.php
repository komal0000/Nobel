@extends('admin.layout.app')
@section('title')
    <a href="{{ route('admin.doctor.index') }}">Doctors</a> /
    <span>Add</span>
@endsection
@section('content')
    <form action="{{ route('admin.doctor.add') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-5 mb-3">
                <label for="image">Image</label>
                <input type="file" name="image" id="image" class="form-control dropify" accept="image/*">
            </div>
            <div class="col-md-7 mb-3">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="title">Name <span style="color: red;">*</span></label>
                        <input type="text" name="title" id="title" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="position">Position <span style="color: red;">*</span></label>
                        <input type="text" name="position" id="position" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="specialty_id">Specialty <span style="color: red;">*</span></label>
                        <select name="specialty_id" id="specialty_id" class="form-control" required>
                            @foreach ($specialties as $specialty)
                                <option value="{{ $specialty->id }}">{{ $specialty->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="location">Location <span style="color: red;">*</span></label>
                        <input type="text" name="location" id="location" class="form-control" required>
                    </div>

                </div>
            </div>
            <div class="col-md-12 mb-3">
                <label for="qualification">Qualifications</label>
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <input type="text" name="qualification[0]" class="form-control" placeholder="Qualification 1">
                    </div>
                    <div class="col-md-6 mb-2">
                        <input type="text" name="qualification[1]" class="form-control" placeholder="Qualification 2">
                    </div>
                    <div class="col-md-6 mb-2">
                        <input type="text" name="qualification[2]" class="form-control" placeholder="Qualification 3">
                    </div>
                    <div class="col-md-6 mb-2">
                        <input type="text" name="qualification[3]" class="form-control" placeholder="Qualification 4">
                    </div>
                </div>
            </div>
            <div class="col-md-12 mb-3">
                <label for="short_description">Short Description</label>
                <textarea name="short_description" id="short_description" class="form-control" rows="3"></textarea>
            </div>

            <div class="col-md-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
@endsection
