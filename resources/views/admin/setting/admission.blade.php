@extends('admin.layout.app')
@section('title')
    <span>Admission</span>
@endsection
@section('content')
    <form action="{{ route('admin.setting.admission') }}" method="post">
        @csrf
        <div class="col-md-12 my-2">
            <label for="detail" class="form-label">Page <span style="color: red;">*</span> </label>
            <textarea type="text" name="detail" id="detail" class="form-control summernote" required>
               {{ old('detail', default: $admission->value ?? '') }}
            </textarea>
        </div>
        <div class="col-md-12 my-2 d-flex justify-content-end">
            <button class="btn btn-success">
                Save
            </button>
        </div>
    </form>
@endsection
