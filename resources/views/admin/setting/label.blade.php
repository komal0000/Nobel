@extends('admin.layout.app')
@section('title')
    <span>Label</span>
@endsection
@section('content')
    <form action="{{ route('admin.setting.label') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-6 my-2">
                <label for="specialitySingle" class="form-label">Speciality (Singular)<span style="color: red;">*</span> </label>
                <input type="text" name="specialitySingle" id="specialitySingle" class="form-control" placeholder="Speciality" required
                    value="{{ old('specialitySingle', default: $values['specialitySingle'] ?? '') }}">
            </div>
            <div class="col-6 my-2">
                <label for="specialityPlural" class="form-label">Speciality (Plural)<span style="color: red;">*</span> </label>
                <input type="text" name="specialityPlural" id="specialityPlural" class="form-control" placeholder="Specialities" required
                    value="{{ old('specialityPlural', default: $values['specialityPlural'] ?? '') }}">
            </div>
        </div>
        <div class="col-md-12 my-2 d-flex justify-content-end">
            <button class="btn btn-success">
                Save
            </button>
        </div>
    </form>
@endsection
