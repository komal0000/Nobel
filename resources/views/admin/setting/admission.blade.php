@extends('admin.layout.app')
@section('title')
    <span>Admission</span>
@endsection
@section('content')
    <form action="{{ route('admin.setting.admission') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="col-md-12 my-2">
            <label for="image" class="form-label">Image <span style="color: red;">*</span> </label>
            <input type="file" name="image" id="image" class="dropify"  data-default-file="{{$values['image'] ?? ''}}">
        </div>
        <div class="col-md-12 my-2">
            <label for="section-1" class="form-label">Section 1 <span style="color: red;">*</span> </label>
            <textarea type="text" name="section_1" id="section-1" class="form-control summernote" required>
               {{ old('section-1', default: $values['section-1'] ?? '') }}
            </textarea>
        </div>
        <div class="col-md-12 my-2">
            <label for="section-2" class="form-label">Section 2 <span style="color: red;">*</span> </label>
            <textarea type="text" name="section_2" id="section-2" class="form-control summernote" required>
               {{ old('section-2', default: $values['section-2'] ?? '') }}
            </textarea>
        </div>
        <div class="col-md-12 my-2 d-flex justify-content-end">
            <button class="btn btn-success">
                Save
            </button>
        </div>
    </form>
@endsection
