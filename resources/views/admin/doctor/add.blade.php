@extends('admin.layout.app')
@section('title')
    <a href="{{ route('admin.doctor.index') }}">Doctors</a> /
    <span>Add</span>
@endsection
@section('content')
    <form action="{{ route('admin.doctor.add') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-5">
                <div class="col-md-12 mb-3">
                    <label for="image">Profile Image</label>
                    <input type="file" name="image" id="image" class="form-control">
                </div>
            </div>
            <div class="col-md-7">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="name">Name <span style="color: red;">*</span></label>
                        <input type="text" name="name" id="name" class="form-control dropify" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="position">Position <span style="color: red;">*</span></label>
                        <input type="text" name="position" id="position" class="form-control" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="location">Location <span style="color: red;">*</span></label>
                        <input type="text" name="location" id="location" class="form-control" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="specialty_id">Specialty <span style="color: red;">*</span></label>
                        <select name="specialty_id" id="specialty_id" class="form-control" required>
                            @foreach ($specialties as $specialty)
                                <option value="{{ $specialty->id }}">{{$specialty->title}}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
            </div>
            <div class="col-md-12 mb-3">
                <label for="qualification">Qualifications</label>
                <textarea name="qualification" id="qualification" class="form-control"></textarea>
                <small class="text-muted">Enter one qualification per line</small>
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
